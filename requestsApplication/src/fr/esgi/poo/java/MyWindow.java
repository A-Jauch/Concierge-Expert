package fr.esgi.poo.java;

import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.ArrayList;
import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableModel;

public class MyWindow extends JFrame{

    private JButton btnSearch = new JButton("Rechercher");
    private JTable jTable;

    public MyWindow() {
        super("Requests application");
        this.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE); //when click on cross "really" close the window
        this.setSize(800, 600); //setSize
        this.setLocationRelativeTo(null); //move the window in the middle of the desktop

        DatabaseManager databaseManager = new DatabaseManager();

        ArrayList<String> tablesList = databaseManager.getTables();

        JComboBox tables = new JComboBox(tablesList.toArray());

        JPanel contentPane = (JPanel) this.getContentPane();
        contentPane.setLayout(new FlowLayout()); //make the elements next to each other (nothing in it = center elements)

        //Label tables
        JLabel lbCat = new JLabel("Choisir une catégorie :");
        lbCat.setBounds(70,0,160,30);
        contentPane.add( lbCat );
        tables.setBounds(40,30,200,30);
        contentPane.add( tables );

        btnSearch.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String[] names = databaseManager.getNameColumns((String) tables.getSelectedItem());
                String[][] datas = databaseManager.select((String) tables.getSelectedItem());

                if (jTable != null) {
                    TableModel dataModel = new DefaultTableModel(datas, names);
                    jTable.setModel(dataModel);
                } else {

                    jTable = new JTable(datas, names);
                    jTable.setAutoResizeMode(JTable.AUTO_RESIZE_OFF);
                    JScrollPane sp = new JScrollPane(jTable, JScrollPane.VERTICAL_SCROLLBAR_AS_NEEDED, JScrollPane.HORIZONTAL_SCROLLBAR_AS_NEEDED);
                    contentPane.add(sp);
                    setVisible(true);
                }
            }
        });
        contentPane.add(btnSearch);
    }

}
