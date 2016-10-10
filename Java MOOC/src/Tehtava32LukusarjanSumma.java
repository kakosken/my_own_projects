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
public class Tehtava32LukusarjanSumma {
    public static void main(String[] args) {
        Scanner lukija = new Scanner(System.in);
        
        System.out.print("Mihin asti? ");
        int n = Integer.parseInt(lukija.nextLine());
        int tulos = 0;
        int i = 0;
        while ( i < n ) {
        tulos = tulos + (n-i);
        i++;
            
        }
        System.out.println("Summa on " + tulos);
    }
}
