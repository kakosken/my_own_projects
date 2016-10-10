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
public class MetodinParametrit {
    public static void tervehdi(String nimi) {
        System.out.println("Hei " + nimi + ", terveiset metodimaailmasta!");
    }
    public static void main(String[] args) {
        
        String nimi1 = "Antti";
        String nimi2 = "Mikkola";
              
        tervehdi(nimi1 + " " + nimi2);
        
        int ika = 24;
        tervehdi("Juhana " + ika + " vuotta");
        
    }
    
}
