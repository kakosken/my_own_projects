
import java.util.Scanner;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author rivetech
 */
public class MetodiHarjotuksia {
    public static void main(String[] args) {
        Scanner lukija = new Scanner(System.in);
        
        int eka = palautetaanLuku1();
        int toka = palautetaanLuku2();
        int kolmas = palautetaanLuku3();
        
        System.out.println("Kirjoita kenttään jokin seuraavista luvuista: yksi, kaksi tai kolme");
        String yksi = lukija.nextLine();
        
        if ( yksi.equals("yksi") ) {
            System.out.println("metodi palautti luvun: " + eka);
        }
        
        System.out.println("Kirjoita kenttään jokin seuraavista luvuista: yksi, kaksi tai kolme");
        String kaksi = lukija.nextLine();
        
        if ( kaksi.equals("kaksi") ) {
            System.out.println("metodi palautti luvun: " + toka);
        }

        System.out.println("Kirjoita kenttään jokin seuraavista luvuista: yksi, kaksi tai kolme");
        String kolme = lukija.nextLine();
        
        if ( kolme.equals("kolme") ) {
            System.out.println("metodi palautti luvun: " + kolmas);
        }

        
    }
    
    public static int palautetaanLuku1() {
        return 8;
    }
    public static int palautetaanLuku2() {
        return 9;
    }
    public static int palautetaanLuku3() {
        return 10;
    }
}
    
