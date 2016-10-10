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
public class Tehtava31AlarajaJaYlaraja {
    public static void main(String[] args) {
        Scanner lukija = new Scanner(System.in);
        
        
        System.out.print("Ensimmäinen: " );
        int luku1 = Integer.parseInt(lukija.nextLine());
        System.out.print("Viimeinen: " );
        int luku2 = Integer.parseInt(lukija.nextLine());

        while ( luku1 <= luku2 ) {
            System.out.println(luku1);
            luku1++;
            if (luku2 < luku1) {
                break;
            }
        }
    }
}
