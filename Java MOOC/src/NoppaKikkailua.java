/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


import javax.swing.*;
import java.util.*;
/**
 *
 * @author rivetech
 */
public class NoppaKikkailua 
{
    public static void main(String[] args)
    {
        
        aloitusPaneeli();
        String nimi = pelaajaYksi();
        String nimiKaksi = pelaajaKaksi();     
        JOptionPane.showMessageDialog(null, "Tervetuloa noppapeliin " + nimi + " ja " + nimiKaksi);
        int a = noppa();
        int b = noppaKaksi();
        int c = noppaKolme();
        int d = noppaNelja();
        int tulosYksi = a + b;
        int tulosKaksi = c + d;
        
        JOptionPane.showMessageDialog(null, "Ensimmäisenä vuorossa " + nimi + ", paina ok näppäintä heittääksesi nopat!");
        JOptionPane.showMessageDialog(null, nimi + " heitti ensimmäisellä nopallaan luvun " + a + " \n ja toisella nopalla luvun " + b);
        JOptionPane.showMessageDialog(null, "Seuraavana vuorossa " + nimiKaksi + ", paina ok näppäintä heittääksesi nopat!");
        JOptionPane.showMessageDialog(null, nimiKaksi + " heitti ensimmäisellä nopallaan luvun " + c + " \n ja toisella nopalla luvun " + d);
                
                        
            if (tulosYksi > tulosKaksi)   
            {
                  JOptionPane.showMessageDialog(null, nimi + " voitti " + (tulosYksi - tulosKaksi) + " pisteellä!");
            }
            if (tulosYksi < tulosKaksi) 
            {
                  JOptionPane.showMessageDialog(null, nimiKaksi + " voitti " + (tulosKaksi - tulosYksi) + " pisteellä!");
            }
            else if (tulosYksi == tulosKaksi)
            {
                  JOptionPane.showMessageDialog(null, nimi + " ja " + nimiKaksi + " päätyivät tasapeliin!");
            }            
    }
    static void aloitusPaneeli()
    {
            JOptionPane.showMessageDialog(null, "Tervetuloa noppapeliin", "Noppapeli (c) Harri", 
                    JOptionPane.QUESTION_MESSAGE);
            JOptionPane.showMessageDialog(null, "Säännöt: \n Tässä pelissä on kaksi pelaajaa, \n "
                    + "jotka syöttävät nimensä ja heittävät \n tämän jälkeen vuorollaan"
                    + " nopat! \n Peli laskee yhteen noppien silmäluvut, \n sekä ilmoittaa kumpi pelaaja"
                    + " voitti \n ja kuinka suurella "
                    + "erotuksella. " + "", "Noppapeli (c) Harri", 
                    JOptionPane.QUESTION_MESSAGE);
    }
    static String pelaajaYksi()
    {
        String nimiYksi = "";
        nimiYksi = JOptionPane.showInputDialog("Syötä ensimmäisen heittäjän nimi:", "pelaaja 1");
        return nimiYksi;
    }
    static String pelaajaKaksi()
    {
        String nimiKaksi = "";
        nimiKaksi = JOptionPane.showInputDialog("Syötä toisen heittäjän nimi:", "pelaaja 2");
        return nimiKaksi;
    }
    public static int noppa()
    {
        Random random = new Random();
        int z = random.nextInt(6) + 1;
        return z;
    }
    public static int noppaKaksi()
    {
        Random random = new Random();
        int z = random.nextInt(6) + 1;
        return z;
    }
    public static int noppaKolme()
    {
        Random random = new Random();
        int z = random.nextInt(6) + 1;
        return z;
    }
    public static int noppaNelja()
    {
        Random random = new Random();
        int z = random.nextInt(6) + 1;
        return z;
    }
}
