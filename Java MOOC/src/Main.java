/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



import java.awt.BorderLayout;
import java.awt.GridBagLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JOptionPane;
import javax.swing.JPanel;

/**
 *
 * @author rivetech
 */
public class Main {

    private static void createAndShowUI() {

        JOptionPane.showMessageDialog(null, "Tervetuloa noppapeliin", "Noppapeli (c) Harri",
        JOptionPane.QUESTION_MESSAGE);

        JFrame frame = new JFrame("Noppakikkailu");
        Aloitus aloitus = new Aloitus();
        // Asetetaan kehyksen koko
        frame.setSize(700,500);
        // Pistetään kehys näkyviin
        frame.setVisible(true);
        frame.setLocationRelativeTo(null);
        // Ruksista sulkeutuu
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        // Tehdään paneeli ja määritellään se käyttämään GridBagLayouttia
        JPanel paneeli = new JPanel ();
        frame.getContentPane().add(paneeli, BorderLayout.CENTER);
        frame.getContentPane().add(aloitus, BorderLayout.WEST);

                JButton pelaa = new JButton(" >> JavaProgrammingForums.com <<");
        //Add action listener to button
        pelaa.addActionListener(new ActionListener() {
 
            public void actionPerformed(ActionEvent e)
            {
                //Execute when button is pressed
                System.out.println("You clicked the button");
            }
        });      
 
        frame.getContentPane().add(pelaa);

        frame.setVisible(true);

  }
    public static void main(String[] args)
    {

       java.awt.EventQueue.invokeLater(new Runnable() {
         public void run() {
            createAndShowUI();
         }
      });

    }

}
