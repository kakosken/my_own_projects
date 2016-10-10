/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


import java.util.Scanner;
/**
 *
 * @author rivetech
 */
public class Tehtava52NimenKaantaminen 
{
    public static void main(String[] args)
    {
        Scanner lukija = new Scanner(System.in);
        System.out.print("Anna nimi: ");
        String nimi = lukija.nextLine();
        int pituus = nimi.length();
        System.out.print("Nimi väärinpäin: ");
        
        while (pituus > 0)
        {
            int i = 0;
            char kirjain = nimi.charAt(pituus-i);
            System.out.print(kirjain);
            i++;
        }
    }
}
