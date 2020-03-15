#ifndef FORM_H_INCLUDED
#define FORM_H_INCLUDED

#include <gtk/gtk.h>
#include <mysql/mysql.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>

static void lastName_clicked(GtkWidget *widget, GtkWidget *entry);

static void firstName_clicked(GtkWidget *widget, GtkWidget *entry);

static void address_clicked(GtkWidget *widget, GtkWidget *entry);

static void email_clicked(GtkWidget *widget, GtkWidget *entry);

static void job_clicked(GtkWidget *widget, GtkWidget *entry);

static void phoneNumber_clicked(GtkWidget *widget, GtkWidget *entry);

void add(GtkWidget *widget, GtkWidget *window);

void form();


void verif(GtkWidget *widget, GtkWidget *window);

void finish_with_error(MYSQL *con);

#endif // FORM_H_INCLUDED
