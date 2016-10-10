/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package Harjoitukset_MOOC_Viikko2;

import java.util.Scanner;

/**
 *
 * @author rivetech
 */
public class Tehtava36ParillisetJaParittomat {
    public static void main(String[] args) {
        Scanner lukija = new Scanner(System.in);
        
        System.out.println("Syötä luvut: ");
        int summa = 0;
        int lukumaara = 0;
        int parillinen = 0;
        int pariton = 0;
        
        
        while (true) {
        int luku = Integer.parseInt(lukija.nextLine());
            summa = summa + luku;
            lukumaara++;
            if (luku % 2 == 0) {
                parillinen++;
            } else {
                pariton++;
            }
            if ( luku == -1 ) {
            summa++;
            lukumaara--;
            pariton--;
            break;
        }
        } 
        System.out.println("Kiitos ja näkemiin!");
        System.out.println("Summa: " + summa);
        System.out.println("Lukuja: " + lukumaara);
        System.out.println("Keskiarvo: " + (summa/(double)lukumaara));
        System.out.println("Parillisia: " + parillinen);
        System.out.println("Parittomia: " + pariton);
        
    }

}    

