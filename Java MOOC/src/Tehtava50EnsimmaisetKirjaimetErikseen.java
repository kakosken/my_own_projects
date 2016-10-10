/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


import java.util.Scanner;
/**
 *
 * @author rivetech
 */
public class Tehtava50EnsimmaisetKirjaimetErikseen 
{
    public static void main(String[] args)
    {
        Scanner lukija = new Scanner(System.in);
        System.out.print("Anna nimi: ");
        String nimi = lukija.nextLine();
        char ekaKirjain = nimi.charAt(0);
        char tokaKirjain = nimi.charAt(1);
        char kolmasKirjain = nimi.charAt(2);
        
        int pituus = nimi.length();
            if (pituus > 2)
            {
        System.out.println("1. kirjain: " + ensimmainenKirjain(nimi));
        System.out.println("2. kirjain: " + toinenKirjain(nimi));
        System.out.println("3. kirjain: " + kolmasKirjain(nimi));
            }
            else
            {
                System.out.println("Nimi oli liian lyhyt!");
            }
        

    }
    public static char ensimmainenKirjain(String nimi)
    {
        char ekaKirjain = nimi.charAt(0);
        return ekaKirjain;
    }
    public static char toinenKirjain(String nimi)
    {
        char tokaKirjain = nimi.charAt(1);
        return tokaKirjain;
    }
    public static char kolmasKirjain(String nimi)
    {
        char kolmasKirjain = nimi.charAt(2);
        return kolmasKirjain;
    }
}