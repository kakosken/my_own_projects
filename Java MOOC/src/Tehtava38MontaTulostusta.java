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
public class Tehtava38MontaTulostusta {
        public static void tulostaTeksti() {
        System.out.println("Alussa olivat suo, kuokka ja Java.");
    }
    public static void main(String[] args) {
        Scanner lukija = new Scanner(System.in);
        
        System.out.println("Montako kertaa teksti tulostetaan?");
        int lukumaara = Integer.parseInt(lukija.nextLine());
        
        while (lukumaara > 0){
        tulostaTeksti();
        lukumaara--;
        
        }
    }
}