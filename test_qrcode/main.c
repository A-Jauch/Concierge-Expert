#include <stdbool.h>
#include <stddef.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "qrcode.h"
#include <math.h>
#include <SDL2/SDL.h>
#include <SDL2/SDL_image.h>

// gcc main.c qrcode.c $(sdl2-config --cflags --libs) -o prog

static void doBasicDemo(void);
static void printQr(const uint8_t qrcode[]);
void SDL_ExitWithError(const char *message);
int main(int argc, char **argv) {
    doBasicDemo();
    return EXIT_SUCCESS;
}

static void doBasicDemo(void) {
    const char *text = "Nom: Jean-François; Prenom: Anthony; Métier: Anticonstitutionnelement;";                // User-supplied text
    enum qrcodegen_Ecc errCorLvl = qrcodegen_Ecc_HIGH;  // Error correction level

    // Make and print the QR Code symbol
    uint8_t qrcode[qrcodegen_BUFFER_LEN_MAX];
    uint8_t tempBuffer[qrcodegen_BUFFER_LEN_MAX];
    bool ok = qrcodegen_encodeText(text, tempBuffer, qrcode, errCorLvl,qrcodegen_VERSION_MIN, qrcodegen_VERSION_MAX, qrcodegen_Mask_AUTO, true);
    if (ok)
        printQr(qrcode);
}

// Prints the given QR Code to the console.
static void printQr(const uint8_t qrcode[]) {

    /* Initialisation fichier */
    const char *path = "./receive_qrcode/qr_code_1.png";

    /* Initialisation SDL */
    SDL_Window *window = NULL;
    SDL_Renderer *renderer = NULL;
    SDL_Surface *screen;

    //Lancement SDL
    if(SDL_Init(SDL_INIT_EVERYTHING) != 0)
        SDL_ExitWithError("Initialisation SDL");

    //Création fenêtre
    window = SDL_CreateWindow("Qr Code",SDL_WINDOWPOS_CENTERED,SDL_WINDOWPOS_CENTERED,800,800,0);
    if(window == NULL){
        SDL_ExitWithError("Creation fenetre echouee");
    }

    renderer = SDL_CreateRenderer(window, -1,SDL_RENDERER_TARGETTEXTURE); // -1 driver pour affichage

    if(renderer == NULL){
        SDL_ExitWithError("Creation rendue echouee");
    }

    /* Changer la couleur de la fenêtre */
    //SDL_SetRenderDrawColor(renderer, 255, 0, 0, 255);
    //SDL_RenderClear(renderer);

    /* Affichage du qr code */
    int size = qrcodegen_getSize(qrcode); // size = 49
    int border = 4;
    int new_y = 0;

    for (int y = -border; y < size + border; y++) {
        new_y = y*10+20;
        for (int x = -border; x < size + border; x++) {

            fputs((qrcodegen_getModule(qrcode, x, y) ? "##" : "  "), stdout);

            if( qrcodegen_getModule(qrcode, x, y) ){
                for(int w=0;w<20;w++){
                    SDL_SetRenderDrawColor(renderer,0, 0, 0, 255);
                    SDL_Rect rect;
                    rect.x = x*10+20;
                    rect.y = new_y;
                    rect.w = 10;
                    rect.h = 10;
                    SDL_RenderFillRect(renderer, &rect);
                    SDL_RenderPresent(renderer);
                }
            } else {
                for(int z=0;z<20;z++) {
                    SDL_SetRenderDrawColor(renderer, 255, 255, 255, 255);
                    SDL_Rect rect;
                    rect.x = x*10+20;
                    rect.y = new_y;
                    rect.w = 10;
                    rect.h = 10;
                    SDL_RenderFillRect(renderer, &rect);
                    SDL_RenderPresent(renderer);
                }
            }

        }
        fputs("\n", stdout);
    }
    fputs("\n", stdout);


    //IMG_SaveJPG(path,screen,50);

    SDL_bool program_lanched = SDL_TRUE;

    while(program_lanched)
    {
        SDL_Event event;
        while(SDL_PollEvent(&event) ) //recup n'importe quel evenement sans bloquer le prog
        {
            switch(event.type) //changer le type de event
            {
                case SDL_QUIT:  //pour associer le type a l'action

                    program_lanched = SDL_FALSE;

                    /* Exportation PNG */
                    screen = SDL_CreateRGBSurface(0, 750, 750, 32, 0x00ff0000, 0x0000ff00, 0x000000ff, 0xff000000);
                    SDL_RenderReadPixels(renderer, NULL, SDL_PIXELFORMAT_RGBA32, screen->pixels, screen->pitch);
                    IMG_SavePNG(screen, path);
                    if (IMG_SavePNG(screen,path) != 0)
                        SDL_ExitWithError("Failed screenshot");
                    SDL_FreeSurface(screen);
                    break;

                default:
                    break;

            }
        }
    }



    SDL_DestroyRenderer(renderer);
    SDL_DestroyWindow(window);
    SDL_Quit();
}

void SDL_ExitWithError(const char *message)
{
    SDL_Log("ERREUR : %s > %s\n", message, SDL_GetError()); // pour eviter d'ecrire a chaque fois les log Erreur : ecran , init etc
    SDL_Quit();
    exit(EXIT_FAILURE);
}

