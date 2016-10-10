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
public class Vertailu 
{
    public static void main(String[] args)
    {
        Scanner lukija = new Scanner(System.in);
        double a;
        double b;
        System.out.println("Tämä ohjelma vertaa ja ilmoittaa kumpi luku on suurempi, ensimmäinen vai toinen luku");
        System.out.println("Syötä ensimmäinen luku: ");
        a = lukija.nextDouble();
        System.out.println("Syötä toinen luku: ");
        b = lukija.nextDouble();
        
        if ( a == b ) {
            System.out.println("Luvut ovat yhtäsuuret!");
        }
            else if (a > b)
                System.out.println("Ensimmäinen luku on näin paljon suurempi kuin toinen: " + (a-b));
            else 
                System.out.println("Toinen luku on näin paljon suurempi kuin ensimmäinen: " + (b-a));
        
        
        
    }
}
