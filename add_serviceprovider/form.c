#include <gtk/gtk.h>
#include <mysql/mysql.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>
// cc `pkg-config --cflags gtk+-3.0` form.c -o hello `pkg-config --libs gtk+-3.0` -I/usr/include/mysql -lmysqlclient $(sdl2-config --cflags --libs) -lSDL2_image

GtkWidget *lastName,
        *lastNameForm,

        *firstName,
        *firstNameForm,

        *address,
        *addressForm,

        *mail,
        *mailForm,

        *job,
        *jobForm,

        *phoneNumber,
        *phoneNumberForm,


          *hbox, *button, *entry;

GtkBuilder *builder;


const char *receiveFirstName,
        *receiveLastName,
        *receiveEmail,
        *receiveAddress,
        *receiveJob,
        *receivePhoneNumber;


static void lastName_clicked(GtkWidget *widget, GtkWidget *entry) {

    receiveLastName = gtk_entry_get_text(GTK_ENTRY(entry));
    g_print("%s\n", receiveLastName);


}


static void firstName_clicked(GtkWidget *widget, GtkWidget *entry) {

    receiveFirstName = gtk_entry_get_text(GTK_ENTRY(entry));
    g_print("%s\n", receiveFirstName);


}

static void address_clicked(GtkWidget *widget, GtkWidget *entry) {

    receiveAddress = gtk_entry_get_text(GTK_ENTRY(entry));
    g_print("%s\n", receiveAddress);



}

static void email_clicked(GtkWidget *widget, GtkWidget *entry) {

    receiveEmail = gtk_entry_get_text(GTK_ENTRY(entry));
    g_print("%s\n", receiveEmail);

}

static void job_clicked(GtkWidget *widget, GtkWidget *entry) {

    receiveJob = gtk_entry_get_text(GTK_ENTRY(entry));
    g_print("%s\n", receiveJob);


}


static void phoneNumber_clicked(GtkWidget *widget, GtkWidget *entry) {

    receivePhoneNumber = gtk_entry_get_text(GTK_ENTRY(entry));
    g_print("%s\n", receivePhoneNumber);

}




void finish_with_error(MYSQL *con) {

    fprintf(stderr, "%s\n", mysql_error(con));
    mysql_close(con);
    exit(1);
}

    void add(GtkWidget *widget, GtkWidget *window) {
    MYSQL *con = mysql_init(NULL); //NULL = alocates / initializes and returns a new object

    if (con == NULL) {
        fprintf(stderr, "%s\n", mysql_error(con));
    }


    if (mysql_real_connect(con, "localhost", "tedanvi", "kLKLxEe8M1EfOdvG", "concierge_expert", 0, NULL, 0) == NULL) {
        finish_with_error(con);
    }

    //verif mail exist
    char testMail[] = "SELECT id FROM serviceprovider WHERE mail = '";
    strcat(testMail, receiveEmail);
    strcat(testMail, "'");


    if (mysql_query(con, testMail)) {
        finish_with_error(con);
    }

    MYSQL_RES *result = mysql_store_result(con);

    if (result == NULL) {
        finish_with_error(con);
    }

    int num_rows = mysql_num_rows(result);

    if (num_rows == 0) {
        int8_t reqInsert[255] = "INSERT INTO serviceprovider (firstName, lastName, mail, tel, qrcode) VALUES('";
        strcat(reqInsert, receiveFirstName);
        strcat(reqInsert, "','");
        strcat(reqInsert, receiveLastName);

        strcat(reqInsert, "','");
        strcat(reqInsert, receiveEmail);
        strcat(reqInsert, "','");
        strcat(reqInsert, receivePhoneNumber);
        strcat(reqInsert, "','");
        strcat(reqInsert, "/qrcode/num1");
        strcat(reqInsert, "')");

        if (mysql_query(con, reqInsert)) {
            finish_with_error(con);
        }
    } else {

        printf("The email is already used");
    }

    mysql_free_result(result);
    mysql_close(con);
}


void verif(GtkWidget *widget, GtkWidget *window) {

    MYSQL *con = mysql_init(NULL);

    if (con == NULL) {
        fprintf(stderr, "%s\n", mysql_error(con));
    }

    if (mysql_real_connect(con, "localhost", "tedanvi", "kLKLxEe8M1EfOdvG", "concierge_expert", 0, NULL, 0) == NULL) {
        finish_with_error(con);
    }

    char testCon[500] = "SELECT id FROM serviceprovider WHERE mail = '";
    strcat(testCon, receiveEmail);
    strcat(testCon, "' AND tel = '");
    strcat(testCon, receivePhoneNumber);
    strcat(testCon, "'");

    if (mysql_query(con, testCon)) {
        finish_with_error(con);
    }

    MYSQL_RES *result = mysql_store_result(con);

    if (result == NULL) {
        finish_with_error(con);
    }

    int num_rows = mysql_num_rows(result);

    if (num_rows == 0) {

        printf("Email or Phone Number invalid");

    } else {
        printf("ok");
        //exit(1);
    }

    mysql_free_result(result);
    mysql_close(con);
}

void form(){GtkWidget *window;

    builder = gtk_builder_new_from_file("provider.glade");
    gtk_builder_connect_signals(builder, NULL);

    window = GTK_WIDGET(gtk_builder_get_object(builder, "window"));
    gtk_widget_show(window);

    lastName = GTK_WIDGET(gtk_builder_get_object(builder, "lastName"));
    lastNameForm = GTK_WIDGET(gtk_builder_get_object(builder, "lastNameForm"));

    firstName = GTK_WIDGET(gtk_builder_get_object(builder, "firstName"));
    firstNameForm = GTK_WIDGET(gtk_builder_get_object(builder, "firstNameForm"));

    address = GTK_WIDGET(gtk_builder_get_object(builder, "address"));
    addressForm = GTK_WIDGET(gtk_builder_get_object(builder, "addressForm"));

    mail = GTK_WIDGET(gtk_builder_get_object(builder, "mail"));
    mailForm = GTK_WIDGET(gtk_builder_get_object(builder, "mailForm"));

    job = GTK_WIDGET(gtk_builder_get_object(builder, "job"));
    jobForm = GTK_WIDGET(gtk_builder_get_object(builder, "jobForm"));

    phoneNumber = GTK_WIDGET(gtk_builder_get_object(builder, "phoneNumber"));
    phoneNumberForm = GTK_WIDGET(gtk_builder_get_object(builder, "phoneNumberForm"));

    button = GTK_WIDGET(gtk_builder_get_object(builder, "button"));







    g_signal_connect(button, "clicked", G_CALLBACK(lastName_clicked), lastNameForm);
    g_signal_connect(button, "clicked", G_CALLBACK(firstName_clicked), firstNameForm);
    g_signal_connect(button, "clicked", G_CALLBACK(address_clicked), addressForm);
    g_signal_connect(button, "clicked", G_CALLBACK(email_clicked), mailForm);
    g_signal_connect(button, "clicked", G_CALLBACK(job_clicked), jobForm);
    g_signal_connect(button, "clicked", G_CALLBACK(phoneNumber_clicked), phoneNumberForm);
    g_signal_connect(button,"clicked",G_CALLBACK(add),window);
    g_signal_connect(button, "clicked", G_CALLBACK(gtk_main_quit), NULL);


    g_signal_connect(window, "delete-event", G_CALLBACK(gtk_main_quit), NULL);

    gtk_widget_show_all(window);


    gtk_main();}


