package fr.esgi.poo.java;

import java.awt.desktop.SystemSleepEvent;
import java.sql.*;
import java.util.ArrayList;
import java.util.Arrays;

import javax.swing.*;
import javax.swing.plaf.nimbus.NimbusLookAndFeel;
import javax.swing.plaf.nimbus.State;
import javax.xml.crypto.Data;

public class Main {

    public static void main(String[] args) throws UnsupportedLookAndFeelException { //JVM will show the error (not likely to on windows or linux)

        //Apply look'n feel on window
        UIManager.setLookAndFeel(new NimbusLookAndFeel());

        //Start the window
        MyWindow myWindow = new MyWindow();
        myWindow.setVisible(true); //make the window appear

    }

}
