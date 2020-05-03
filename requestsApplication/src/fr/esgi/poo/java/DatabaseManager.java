package fr.esgi.poo.java;

import java.sql.*;
import java.util.ArrayList;

public class DatabaseManager {
    private Connection con;

    public DatabaseManager() {
        try {
            this.con = DriverManager.getConnection("jdbc:mysql://localhost:3306/concierge_expert?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC",
                    "tedanvi",
                    "kLKLxEe8M1EfOdvG");
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public String[][] select(String table) {
        int size = getSize(table);
        int nb = getNumberResults(table);

        String[][] ret = new String[nb][size];
        try {
            Statement req = con.createStatement();
            ResultSet res = req.executeQuery("SELECT * FROM " + table);
            int j = 0;
            while (res.next()) {
                for (int i = 1; i < size; i++) {
                    ret[j][i - 1] = res.getString(i);
                }
                j++;
            }
            return ret;

        } catch (SQLException e) {
            e.printStackTrace();
            return null;
        }
    }

    public int getSize(String table) {
        try {
            Statement req = con.createStatement();
            ResultSet res = req.executeQuery("DESCRIBE " + table);

            int size = 0;
            while (res.next()) {
                size++;
            }
            return size;

        } catch (SQLException e) {
            e.printStackTrace();
            return 0;
        }
    }

    public ArrayList<String> getTables() {
        ArrayList<String> tables = new ArrayList<>();
        try {
            Statement req = con.createStatement();
            ResultSet res = req.executeQuery("SHOW TABLES");

            while (res.next()) {
                tables.add(res.getString(1));
            }

            return tables;

        }  catch (SQLException e) {
            e.printStackTrace();
            return null;
        }
    }

    public String[] getNameColumns(String table) {
        int size = getSize(table);
        String[] names = new String[size];
        try {
            Statement req = con.createStatement();
            ResultSet res = req.executeQuery("DESCRIBE " + table);
            int i = 0;
            while (res.next()) {
                names[i] = res.getString(1);
                i++;
            }

            return names;
        } catch (SQLException e) {
            e.printStackTrace();
            return null;
        }
    }

    public int getNumberResults(String table) {
        try {
            Statement req = con.createStatement();
            ResultSet res = req.executeQuery("SELECT COUNT(*) FROM " + table);
            res.next();
            return res.getInt(1);

        } catch (SQLException e) {
            e.printStackTrace();
            System.out.println("error");
        }
        return 0;
    }
}
