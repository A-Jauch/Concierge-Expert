package fr.esgi.application;

import java.awt.*;
import java.awt.event.*;
import java.awt.geom.Ellipse2D;
import java.awt.image.ImageObserver;
import java.sql.Connection;
import java.sql.DriverManager;
import java.text.AttributedCharacterIterator;
import java.util.ArrayList;
import javax.swing.*;
import javax.swing.text.DefaultCaret;
import java.sql.*;
import java.util.Random;

public class MyWindow extends JFrame {

    public MyWindow(String[] clientsList, String[] nameJobs, String[] serviceProviderName, String[] serviceName, String[] listInterventions) {

        super("Service Provider Application");
        this.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE); //when click on cross "really" close the window
        this.setSize(650, 750); //setSize
        this.setLocationRelativeTo(null); //move the window in the middle of the desktop

        JPanel contentPane = (JPanel) this.getContentPane(); //get zone in window
        contentPane.setLayout( null );
        contentPane.setBackground(new Color(75, 178, 242));

        //Label Jobs
        JLabel lbJob = new JLabel("Choisir une profession :");
        lbJob.setBounds(70,0,160,30);
        JComboBox jobList = new JComboBox(nameJobs);
        contentPane.add( lbJob );
        jobList.setBounds(40,30,200,30);
        contentPane.add( jobList );

        //validate Job
        JButton btnJob = new JButton("OK");
        btnJob.setBounds(240,30,50,30);
        btnJob.setBackground(new Color(242, 92, 5));
        contentPane.add( btnJob );
        btnJob.addActionListener( new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent actionEvent) {
                printServiceProvider(jobList,serviceProviderName,contentPane);
            }
        });

        //Label ServiceProvider
        JLabel lbServiceProvider = new JLabel("Choisir un prestataire :");
        lbServiceProvider.setBounds(70,65,160,30);
        contentPane.add( lbServiceProvider );

        //Label Service
        JLabel lbService = new JLabel("Choisir un service :");
        lbService.setBounds(410,0,160,30);
        JComboBox serviceList = new JComboBox(serviceName);
        contentPane.add( lbService );
        serviceList.setBounds(360,30,200,30);
        contentPane.add( serviceList );

        //validate Service
        JButton btnService = new JButton("OK");
        btnService.setBounds(560,30,50,30);
        btnService.setBackground(new Color(242, 92, 5));
        contentPane.add( btnService );
        btnService.addActionListener( new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent actionEvent) {
                printClients(serviceList,clientsList,serviceName,contentPane);
            }
        });

        //Label Clients
        JLabel lbClient = new JLabel("Choisir un client:");
        lbClient.setBounds(410,65,160,30);
        contentPane.add( lbClient );

        //CHOIX CLIENT AND PRESTATAIRE
        JList<String> list = printClients(serviceList, clientsList, serviceName, contentPane);
        list.setBounds(370,100,220,480);
        contentPane.add(list);

        JList<String> list2 = printServiceProvider(jobList,serviceProviderName,contentPane);
        list2.setBounds(50,100,180,480);
        contentPane.add(list2);

        JButton btnAssignation = new JButton("Assigner");
        btnAssignation.setBounds(220,600,160,30);
        btnAssignation.setBackground(new Color(242, 203, 5));
        contentPane.add( btnAssignation );
        btnAssignation.addActionListener( new ActionListener() {

            @Override
            public void actionPerformed(ActionEvent actionEvent) {
                String[] newName;

                try {
                    //Connection to database
                    Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/concierge_expert?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC",
                            "tedanvi",
                            "kLKLxEe8M1EfOdvG");
                    
                    int idUsers = 0;
                    int idReserv = 0;
                    
                    Statement req = con.createStatement();

                    String indice = list.getSelectedValue();
                    String indiceBis = list2.getSelectedValue();
                    String serviceSelected = serviceList.getSelectedItem().toString();
                    System.out.println("CLIENT : " + indice);
                    System.out.println("SERVICE PROVIDER : " + indiceBis);
                    System.out.println("SERVICE : " + serviceSelected);

                    if( indice == null || indiceBis == null){
                        JLabel lbValidate = new JLabel("Vous devez choisir un prestataire ainsi qu'un client");
                        lbValidate.setBounds(160,570,300,30);
                        contentPane.add( lbValidate );
                        contentPane.updateUI();
                    }else {
                        //Label Clients
                        JLabel lbValidate = new JLabel("Insertion en base de données réussite");
                        lbValidate.setBounds(200,570,250,30);
                        contentPane.add( lbValidate );
                        contentPane.updateUI();

                        //Generate idReservation
                        Random rand = new Random();
                        int idReservation = rand.nextInt(10000);

                        newName =  indice.split(" ");
                        ResultSet clientsId = req.executeQuery("SELECT * FROM client WHERE lastname =  '" + newName[0] + "'");
                        while (clientsId.next()) {
                            idUsers = clientsId.getInt("id");
                        }

                        ResultSet reservationId = req.executeQuery("SELECT * FROM " + serviceSelected + " WHERE idUser =  '" + idUsers + "'");
                        while (reservationId.next()) {
                            idReserv = reservationId.getInt("id");
                            System.out.println("ID RESERVATION : " + reservationId.getInt("id"));
                        }

                        String sql = ("INSERT INTO intervention(spName,clientName,numberReservation,serviceName,idReservation) VALUES(?,?,?,?,?)");
                        PreparedStatement statement = con.prepareStatement(sql);
                        statement.setString(1,indiceBis);
                        statement.setString(2,indice);
                        statement.setInt(3,idReservation);
                        statement.setString(4,serviceSelected);
                        statement.setInt(5,idReserv);
                        statement.executeUpdate();
                    }

                } catch (Exception exc) {
                    exc.printStackTrace();
                }
            }

        });

        JButton btnHistorique= new JButton("Historique des interventions");
        btnHistorique.setBounds(200,630,200,30);
        btnHistorique.setBackground(new Color(242, 92, 5));
        contentPane.add( btnHistorique );
        btnHistorique.addActionListener( new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent actionEvent){
                JFrame frame = createFrame();

                JPanel contentPane2 = (JPanel) frame.getContentPane(); //get zone in window
                contentPane2.setLayout( null );
                contentPane2.setBackground(new Color(75, 178, 242));

                JTextField textField = new JTextField();
                textField.setBounds(300,40,225,35);
                contentPane2.add(textField);

                JLabel lbText = new JLabel("Entrez votre nom de famille ainsi que votre prénom");
                lbText.setBounds(295,11,600,11);
                contentPane2.add( lbText );

                JLabel lbHistorique= new JLabel("Voici ci-dessous votre historique d'interventions : ");
                lbHistorique.setBounds(290,100,300,11);
                contentPane2.add( lbHistorique );

                JButton btnText = new JButton("OK");
                btnText.setBounds(540,41,50,30);
                btnText.setBackground(new Color(242, 92, 5));
                contentPane2.add( btnText );
                btnText.addActionListener( new ActionListener() {
                    @Override
                    public void actionPerformed(ActionEvent actionEvent) {
                        ArrayList<String> itemsIntervention = new ArrayList<String>();
                        try {
                            //Connection to database
                            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/concierge_expert?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC",
                                    "tedanvi",
                                    "kLKLxEe8M1EfOdvG");

                        String inputValue = textField.getText();
                        getHistorique(contentPane2,inputValue,serviceName);

                        } catch (Exception exc) {
                            exc.printStackTrace();
                        }
                    }
                });
            }
        });

    }

    public static int getSizeJob(){
        int jobLength = 0;

        try {
            //Connection to database
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/concierge_expert?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC", "tedanvi", "kLKLxEe8M1EfOdvG");

            //Create statement
            Statement req = con.createStatement();

            //Get column table job
            ResultSet sizeJob = req.executeQuery("SELECT COUNT(*) FROM job");
            while (sizeJob.next()) {
                jobLength = sizeJob.getInt(1);
            }

        } catch (Exception exc) {
            exc.printStackTrace();
        }

        return jobLength;
    }

    public static JList<String> printServiceProvider(JComboBox jobList, String[] serviceProviderName, JPanel contentPane){
        System.out.println("###########################################");
        ArrayList<String> items2 = new ArrayList<String>();
        int i = 0;
        try {
            //Connection to database
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/concierge_expert?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC",
                    "tedanvi",
                    "kLKLxEe8M1EfOdvG");

            Statement req = con.createStatement();

            String jobSelected = jobList.getSelectedItem().toString();
            String jobId = null;
            String[] allJobs = new String[getSizeJob()];

            if(jobSelected.equals("Toutes les professions")){
                ResultSet idJobs = req.executeQuery("SELECT * FROM job");
                //Show results Jobs
                while (idJobs.next()) {
                    allJobs[i] = idJobs.getString("id");
                    i++;
                }
                i = 0;

                for (int j = 0; j < allJobs.length ; j++) {
                    ResultSet serviceProvider = req.executeQuery("SELECT * FROM serviceprovider WHERE idJob = " + allJobs[j]);
                    //Show results Jobs
                    while ( serviceProvider.next() ){
                        serviceProviderName[i] = serviceProvider.getString("lastName") + " " + serviceProvider.getString("firstName");
                        items2.add(serviceProviderName[i]);
                        System.out.println(serviceProviderName[i]);
                        i++;
                    }
                }

            }else{
                ResultSet idJob = req.executeQuery("SELECT * FROM job WHERE name = '" + jobSelected + "'");
                //Show results Jobs
                while (idJob.next()) {
                    jobId = idJob.getString("id");
                    i++;
                }

                ResultSet serviceProvider = req.executeQuery("SELECT * FROM serviceprovider WHERE idJob = " + jobId);
                //Show results Jobs
                while (serviceProvider.next()) {
                    serviceProviderName[i] = serviceProvider.getString("lastName") + " " + serviceProvider.getString("firstName");
                    items2.add(serviceProviderName[i]);
                    System.out.println(serviceProviderName[i]);
                    i++;
                }
            }

        } catch (Exception exc) {
            exc.printStackTrace();
        }

        final JList<String> list2 = new JList(items2.toArray());
        list2.setBounds(50,100,180,480);
        contentPane.add(list2);
        list2.repaint();

        return list2;
    }

    public static JList<String> printClients(JComboBox serviceList, String[] clientsList, String[] serviceName, JPanel contentPane){
        ArrayList<String> items = new ArrayList<String>();
        int i = 0;
        int[] listClients = new int[clientsList.length];
        int[] listId = new int[clientsList.length];
        try {
            //Connection to database
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/concierge_expert?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC",
                    "tedanvi",
                    "kLKLxEe8M1EfOdvG");

            Statement req = con.createStatement();

            String serviceSelected = serviceList.getSelectedItem().toString();

            if(serviceSelected.equals("Tous les services")){
                for (int j = 1; j < serviceName.length; j++) {
                    ResultSet clients = req.executeQuery("SELECT * FROM " + serviceName[j] + " WHERE idUser IS NOT NULL");
                    //Show results Clients
                    while (clients.next()) {
                        listClients[i] = clients.getInt("idUser");
                        listId[i] = clients.getInt("id");
                        i++;
                    }
                }
                i = 0;

                for (int j = 0; j < clientsList.length; j++) {
                    ResultSet clientsNomination = req.executeQuery("SELECT * FROM client WHERE id = '" + listClients[j] + "'");
                    //Show results clients
                    while (clientsNomination.next()) {
                        clientsList[i] = clientsNomination.getString("lastName") + " " + clientsNomination.getString("firstName");
                        items.add(clientsList[i]);
                        i++;
                    }
                }
            }else{
                ResultSet clients = req.executeQuery("SELECT * FROM " + serviceSelected + " WHERE idUser IS NOT NULL");
                //Show results Clients
                while (clients.next()) {
                    listClients[i] = clients.getInt("idUser");
                    listId[i] = clients.getInt("id");
                    i++;
                }
                i = 0;

                for (int j = 0; j < clientsList.length; j++) {
                    ResultSet clientsNomination = req.executeQuery("SELECT * FROM client WHERE id = '" + listClients[j] + "'");
                    //Show results clients
                    while (clientsNomination.next()) {
                        clientsList[i] = clientsNomination.getString("lastName") + " " + clientsNomination.getString("firstName");
                        items.add(clientsList[i]);
                        i++;
                    }
                }
            }

        } catch (Exception exc) {
            exc.printStackTrace();
        }

        final JList<String> list = new JList(items.toArray());
        list.setBounds(370,100,180,480);
        contentPane.add(list);
        list.repaint();

        return list;
    }

    public static JFrame createFrame() {
            JFrame frame = new JFrame("Historique");
            frame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
            frame.setSize(890, 550); //setSize
            frame.setLocationRelativeTo(null); //move the window in the middle of the desktop
            frame.setVisible(true);

            return frame;
    }

    public static JList<String> getHistorique(JPanel contentPane2, String inputValue,String[] serviceName){
        ArrayList<String> items = new ArrayList<String>();
        String[] interventions;
        String[] interventionsService;
        int[] interventionsId;
        int interventionLength = 0;

        try {
            //Connection to database
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/concierge_expert?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC",
                    "tedanvi",
                    "kLKLxEe8M1EfOdvG");

            Statement req = con.createStatement();

            ResultSet interventionSize = req.executeQuery("SELECT COUNT(*) FROM intervention WHERE spName = '" + inputValue + "'");
            while (interventionSize.next()) {
                interventionLength = interventionSize.getInt(1);
            }

            interventions = new String[interventionLength];
            interventionsService = new String[interventionLength];
            interventionsId = new int[interventionLength];

            int j=0;
            ResultSet intervention = req.executeQuery("SELECT * FROM intervention WHERE spName = '" + inputValue + "'");
            while (intervention.next()) {
                interventions[j] = intervention.getString("clientName");
                interventionsService[j] = intervention.getString("serviceName");
                interventionsId[j] = intervention.getInt("idReservation");
                j++;
            }

            int[] idUsersReservation = new int[interventionLength];
            Date[] interventionsDate = new Date[interventionLength];
            Time[] interventionsTime = new Time[interventionLength];
            String[] interventionsName = new String[interventionLength];
            String[] newInputValue;

            j=0;
            for (int i = 0; i < interventionLength; i++) {
                newInputValue = interventions[i].split(" ");
                ResultSet interventionSet = req.executeQuery("SELECT * FROM client WHERE lastName = '" + newInputValue[0] + "'");
                while (interventionSet.next()) {
                    idUsersReservation[j] = interventionSet.getInt("id");
                    j++;
                }
            }

            j=1;
            for (int k = 1; k < serviceName.length; k++) {
                ResultSet findServices = req.executeQuery("SELECT * FROM " + serviceName[k]);
                while (findServices.next()) {
                    for (int i = 0; i < interventionLength; i++) {
                        if ( findServices.getInt("idUser") == idUsersReservation[i] && findServices.getString("name").equals(interventionsService[i]) && findServices.getInt("id") == interventionsId[i]  ){
                            interventionsName[i] = findServices.getString("name");
                            interventionsDate[i] = findServices.getDate("date");
                            interventionsTime[i] = findServices.getTime("heureSemaine");
                            items.add("Intervention n°" + j + " chez " + interventions[i] + " pour le service " + interventionsName[i] + " le " + interventionsDate[i] + " pour " + interventionsTime[i] + " heures par semaine");
                            j++;
                        }
                    }
                }
            }

            } catch (Exception exc) {
                exc.printStackTrace();
        }

        final JList<String> listHistoric = new JList(items.toArray());
        listHistoric.setBounds(150,130,800,480);
        contentPane2.add(listHistoric);
        listHistoric.updateUI();

        return listHistoric;
    }

}