
import java.util.Random;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
import java.util.*;
/**
 *
 * @author rivetech
 */
public class NopanHeittoa 
{
    public static void main(String[] args)
    {
        Scanner lukija = new Scanner(System.in);
        Scanner jatka = new Scanner(System.in);

        System.out.println("***********************************");
        System.out.println("** Tervetuloa nopanheitto peliin **");
        System.out.println("***********************************");
        int a = noppa();
        int b = noppaKaksi();
        int c = noppaKolme();
        int d = noppaNelja();
        int tulosYksi = a + b;
        int tulosKaksi = c + d;
        
        
        System.out.print("Syötä ensimmäisen pelaajan nimi: ");
        String nimi = lukija.nextLine();
        System.out.print("Syötä toisen pelaajan nimi: ");
        String nimiKaksi = lukija.nextLine();
        System.out.println("----------------------------------------------");
        System.out.println("Tervetuloa peliin " + nimi + " ja " + nimiKaksi + "!");
        System.out.println("----------------------------------------------");
        System.out.println("Ensimmäisenä vuorossa " + nimi + ", paina Enter näppäintä heittääksesi nopat!");
        jatka.nextLine();
        System.out.println(nimi + " Heitti:");
        System.out.println("Noppa yksi: " + a);
        System.out.println("Noppa kaksi: " + b);
        System.out.println("Yhteensä: " + (tulosYksi));
        System.out.println("----------------------------------------------");
        System.out.println("Toisena vuorossa " + nimiKaksi + ", paina Enter näppäintä heittääksesi nopat!");
        jatka.nextLine();
        System.out.println(nimiKaksi + " Heitti:");
        System.out.println("Noppa yksi: " + c);
        System.out.println("Noppa kaksi: " + d);
        System.out.println("Yhteensä: " + (tulosKaksi));
        System.out.println("----------------------------------------------");
            
            if (tulosYksi > tulosKaksi)   
            {
                System.out.println(nimi + " voitti " + (tulosYksi - tulosKaksi) + " pisteellä!");
            }
            if (tulosYksi < tulosKaksi) 
            {
                System.out.println(nimiKaksi + " voitti " + (tulosKaksi - tulosYksi) + " pisteellä!");
            }
            else if (tulosYksi == tulosKaksi)
            {
                System.out.println("Tasapeli!");
            }            
                        
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
