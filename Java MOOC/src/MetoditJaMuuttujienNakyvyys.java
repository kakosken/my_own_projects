/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package Harjoitukset_MOOC_Viikko2;

/**
 *
 * @author rivetech
 */
public class MetoditJaMuuttujienNakyvyys {
    
    public static void main(String[] args) {
        int luku = 1;
        System.out.println("Pääohjelman muuttujan luku arvo: " + luku);
        kasvataKolmella(luku);
        System.out.println("Pääohjelman muuttujan luku arvo: " + luku);
    }
    
    public static void kasvataKolmella(int luku) {
        System.out.println("Metodin parametrin luku arvo: " + luku);
        luku = luku + 3;
        System.out.println("Metodin parametrin luku arvo: " + luku);
        
    }
    
}
