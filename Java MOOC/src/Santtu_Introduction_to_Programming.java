/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Santtu
 */
public class Santtu_Introduction_to_Programming {
    public static void main(String args[])
    {
        String[] suits = new String [4];
        suits[0] = "paa";
        suits[1] = "olkapaa";
        suits[2] = "peppu";
        suits[3] = "polvet";
        
        System.out.println("Taulun suits koko: "+suits.length);
        
       for(int i=0; i<suits.length; i++)
       {
           System.out.println("Indeksissä "+i+" on "+suits[i]);
       }
        //int index = 0;
        //for (int suit = 0; suit <= 3; suit++) 
       // 
              
    }
}
