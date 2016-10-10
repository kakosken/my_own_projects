
import java.util.Scanner;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author rivetech
 */
public class MetodinOmatMuuttujat {
    public static void main(String[] args) {
    Scanner lukija = new Scanner(System.in);
        
        System.out.println("Anna ensimmäinen luku:");
        int yks = Integer.parseInt(lukija.nextLine());
        
        System.out.println("Anna toinen luku:");
        int kaks = Integer.parseInt(lukija.nextLine());
        
        System.out.println("Anna kolmas luku:");
        int kolme = Integer.parseInt(lukija.nextLine());
        
        double keskiarvonTulos = keskiarvo(yks, kaks, kolme);
        
        System.out.println("Lukujen keskiarvo: " + keskiarvonTulos);
        
    }
    public static double keskiarvo(int luku1, int luku2, int luku3) {
        
        int summa = luku1 + luku2 + luku3;
        double ka = summa / 3.0;
        
        return ka;
    }
}
