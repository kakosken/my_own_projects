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
public class Tehtava33RajoitetunLukusarjanSumma {
    public static void main(String[] args) {
        Scanner lukija = new Scanner(System.in);
        
        System.out.print("Ensimmäinen: ");
        int n1 = Integer.parseInt(lukija.nextLine());
        System.out.print("Viimeinen: ");
        int n2 = Integer.parseInt(lukija.nextLine());

        int tulos = 0;
        while ( n1 <= n2 ) {
        tulos = tulos + n1;
        n1++;
        
        }
        System.out.println("Summa on " + tulos);
    }
}