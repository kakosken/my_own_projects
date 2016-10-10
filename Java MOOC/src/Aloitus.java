/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



import java.awt.BorderLayout;
import java.awt.FlowLayout;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JTextArea;
import javax.swing.JTextField;

/**
 *
 * @author rivetech
 */
public class Aloitus extends JPanel {

JPanel paneeli = new JPanel();
private JLabel pelaajaLabel = new JLabel ("Pelaaja 1: ");
private JTextField pelaaja1 = new JTextField("Syötä nimesi ");


private JLabel pelaajaLabel2 = new JLabel ("Pelaaja 2: ");
private JTextField pelaaja2 = new JTextField("Syötä nimesi ");

final JTextArea alotusTeksti = new JTextArea("Säännöt: \n Tässä pelissä on kaksi pelaajaa, \n "
                    + "jotka syöttävät nimensä ja heittävät \n tämän jälkeen vuorollaan"
                    + " nopat! \n Peli laskee yhteen noppien silmäluvut, \n sekä ilmoittaa kumpi pelaaja"
                    + " voitti \n ja kuinka suurella "
                    + "erotuksella. ");
JPanel paneeli2 = new JPanel();
JPanel paneeli3 = new JPanel();
JPanel paneeli4 = new JPanel();

private JButton pelaa = new JButton("Pelaa!");


public Aloitus(){


    paneeli2.add(alotusTeksti);
    paneeli2.setLayout(new FlowLayout());
    //add(paneeli2);
    paneeli.setLayout(new FlowLayout());
    paneeli.add(pelaajaLabel);
    paneeli.add(pelaaja1);
    paneeli.add(pelaajaLabel2);
    paneeli.add(pelaaja2);
    paneeli.add(pelaa);
    paneeli4.add(pelaa);
    paneeli4.setLayout(new FlowLayout());
    //add(paneeli);

    paneeli3.setLayout(new BorderLayout());
    paneeli3.add(paneeli2, BorderLayout.NORTH);
    paneeli3.add(paneeli4, BorderLayout.SOUTH);
        paneeli3.add(paneeli, BorderLayout.WEST);
        add(paneeli3);


}

}
