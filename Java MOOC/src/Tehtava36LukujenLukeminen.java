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
public class Tehtava36LukujenLukeminen {
    public static void main(String[] args) {
        Scanner lukija = new Scanner(System.in);
        
        System.out.println("Syötä luvut: ");
 
        
        while (true) {
        int luku = Integer.parseInt(lukija.nextLine());
            
        if ( luku == -1 ) {
            break;
        }
        } 
        System.out.println("Kiitos ja näkemiin!");
        
    }
}
