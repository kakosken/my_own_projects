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
public class WhileJaLopetus {
    public static void main(String[] args) {
        Scanner lukija = new Scanner(System.in);
        
        System.out.println("Ikäsi: ");
        
        int ika = Integer.parseInt(lukija.nextLine());
        
        while ( ika < 5 || ika > 85 ) { //ikä pienempi kuin 5 TAI suurempi kuin 85
            System.out.println("Valehtelet!");
            if (ika < 5) {
                System.out.println("Olet niin nuori ettet osaa kirjoittaa!");
            } else if (ika > 85) {
                System.out.println("Olet niin vanha ettet osaa käyttää tietokonetta!");
            }
  
            System.out.println("Syötä ikäsi uudelleen: ");
            ika = Integer.parseInt(lukija.nextLine());
        }
        System.out.println("Ikäsi on siis: " +ika);              
    }
}
