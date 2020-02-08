#include <gtk/gtk.h>
#include <stdio.h>
#include <stdlib.h>
// cc `pkg-config --cflags gtk+-3.0` form.c -o hello `pkg-config --libs gtk+-3.0`

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

const char *receiveInput;

static void button_clicked(GtkWidget *widget, GtkWidget *entry) {

    receiveInput = gtk_entry_get_text(GTK_ENTRY(entry));


    g_print("%s\n", receiveInput);
/*    gtk_editable_select_region(GTK_EDITABLE(entry), 0, -1); // text from 0 to the end
    gtk_editable_copy_clipboard(GTK_EDITABLE(entry));*/
    gtk_entry_set_text(GTK_ENTRY(entry), "Informations envoyées");

}

int main(int argc, char *argv[]) {
    gtk_init(&argc, &argv);

    GtkWidget *window;

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


    g_signal_connect(button, "clicked", G_CALLBACK(button_clicked), lastNameForm);
    g_signal_connect(button, "clicked", G_CALLBACK(button_clicked), firstNameForm);
    g_signal_connect(button, "clicked", G_CALLBACK(button_clicked), addressForm);
    g_signal_connect(button, "clicked", G_CALLBACK(button_clicked), mailForm);
    g_signal_connect(button, "clicked", G_CALLBACK(button_clicked), jobForm);
    g_signal_connect(button, "clicked", G_CALLBACK(button_clicked), phoneNumberForm);
    g_signal_connect(window, "delete-event", G_CALLBACK(gtk_main_quit), NULL);


    gtk_widget_show_all(window);
    gtk_main();
    return 0;
}
