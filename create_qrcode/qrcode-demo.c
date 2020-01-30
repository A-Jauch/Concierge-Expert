#include <stdbool.h>
#include <stddef.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "qrcodegen.h"

static void doBasicDemo(void);
static void printQr(const uint8_t qrcode[]);

int main(void) {
    doBasicDemo();
    return EXIT_SUCCESS;
}

static void doBasicDemo(void) {
    const char *text = "Hello, world!";                // User-supplied text
    enum qrcodegen_Ecc errCorLvl = qrcodegen_Ecc_LOW;  // Error correction level

    // Make and print the QR Code symbol
    uint8_t qrcode[qrcodegen_BUFFER_LEN_MAX];
    uint8_t tempBuffer[qrcodegen_BUFFER_LEN_MAX];
    bool ok = qrcodegen_encodeText(text, tempBuffer, qrcode, errCorLvl,
                                   qrcodegen_VERSION_MIN, qrcodegen_VERSION_MAX, qrcodegen_Mask_AUTO, true);
    if (ok)
        printQr(qrcode);
}

// Prints the given QR Code to the console.
static void printQr(const uint8_t qrcode[]) {
    int size = qrcodegen_getSize(qrcode);
    int border = 4;
    for (int y = -border; y < size + border; y++) {
        for (int x = -border; x < size + border; x++) {
            fputs((qrcodegen_getModule(qrcode, x, y) ? "██" : "  "), stdout);
        }
        fputs("\n", stdout);
    }
    fputs("\n", stdout);
}