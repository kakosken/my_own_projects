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
public class Tehtava30LukuunAsti {
    public static void main(String[] args) {
        Scanner lukija = new Scanner(System.in);
        
        System.out.print("Mihin asti? ");
        
        int luku = 1;
        int luettu = Integer.parseInt(lukija.nextLine());;
      
        while ( luku <= luettu ) {
            System.out.println( luku );
            luku = luku + 1;
        }
    }
}
