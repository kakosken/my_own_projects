package Harjoitukset_MOOC_Viikko2;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author rivetech
 */
public class Tehtava39piste1Tulostelua {
    private static void tulostaTahtia(int maara) {
    // yhden tähden saat tulostettua komennolla
         // System.out.print("*");
        
        int kierros = 0;
        while(kierros < maara){
        System.out.print("*");
        kierros++;
            
        }
        System.out.println("");
        }
    // kutsu tulostuskomentoa n kertaa
    // tulosta lopuksi rivinvaihto komennolla
    // System.out.println("");


public static void main(String[] args) {
    tulostaTahtia(5);
    tulostaTahtia(3);
    tulostaTahtia(9);
}
}
