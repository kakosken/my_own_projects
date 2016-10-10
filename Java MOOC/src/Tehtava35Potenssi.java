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
public class Tehtava35Potenssi {
    public static void main(String[] args) {
        Scanner lukija = new Scanner(System.in);
        
        System.out.print("Anna luku: ");
        int n = Integer.parseInt(lukija.nextLine());
        int i = 0;
        int tulos = 0;
        
        while ( i < n +1 ) {
        tulos = tulos + (int) Math.pow(2, n-i);
            System.out.println("nyt on " +(int) Math.pow(2, n-i) );
        i++;
        
        }
        System.out.println("Tulos on " +tulos);
        
    }
}
