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
public class OmiaMetodeja 
{
    public static void main(String[] args)
    {
        double isonBurgerinHinta = 5.99;
        double mediumBurgerinHinta = 4.50;
        double pienenBurgerinHinta = 3.00;        
        double isotRanskalaisetHinta = 2.50;
        double pienetRanskalaisetHinta = 1.80;
        double isoJuomaHinta = 2.00;
        double pieniJuomaHinta = 1.40;
        int isojenBurgereidenMaara;
        int mediumBurgereidenMaara;
        int pienienBurgereidenMaara;
        int isojenRanskalaistenMaara;
        int pienienRanskalaistenMaara;
        int isojenJuomienMaara;
        int pienienJuomienMaara;
        double veroProsentti = 1.23;
        double lopullinenHinta;
        
        heippa();
        hinnasto(isonBurgerinHinta, mediumBurgerinHinta, pienenBurgerinHinta, isotRanskalaisetHinta, pienetRanskalaisetHinta, isoJuomaHinta, pieniJuomaHinta);
        
        isojenBurgereidenMaara = isojenBmaara();
        mediumBurgereidenMaara = mediumBmaara();
        pienienBurgereidenMaara = pienienBmaara();       
        isojenRanskalaistenMaara = isojenRmaara();
        pienienRanskalaistenMaara = pienienRmaara();
        isojenJuomienMaara = isojenJmaara();       
        pienienJuomienMaara = pienienJmaara();       
        lopullinenHinta = laskeNumerot(isojenBurgereidenMaara, mediumBurgereidenMaara, pienienBurgereidenMaara, isojenRanskalaistenMaara, pienienRanskalaistenMaara, isojenJuomienMaara, pienienJuomienMaara, isonBurgerinHinta, mediumBurgerinHinta, pienenBurgerinHinta, isotRanskalaisetHinta, pienetRanskalaisetHinta, isoJuomaHinta, pieniJuomaHinta, veroProsentti);
        
        System.out.println("");
        System.out.println("*********************************************");
        System.out.println("Lopullinen hinta on: " + lopullinenHinta + " euroa");
        System.out.println("Kiitoksia tilauksesta ja tervetuloa uudelleen!");
        System.out.println("*********************************************");

    }
    static void heippa()
    {
        System.out.println("***********************************");
        System.out.println("*   Tervetuloa Rasvaburgeriin!    *");
    }
    static void hinnasto(double a, double b, double c, double d, double e, double f, double g)
    {
        System.out.println("***************MENU****************");
        System.out.println("*  Burgerit:                      *");
        System.out.println("*  Iso burgeri: " + a + " €            *");
        System.out.println("*  Medium burgeri: " + b + " €          *");
        System.out.println("*  Pieni burgeri: " + c + " €           *");
        System.out.println("***********************************");
        System.out.println("*  Ranskalaiset:                  *");
        System.out.println("*  Isot ranskalaiset: " + d + " €       *");
        System.out.println("*  Pienet ranskalaiset: " + e + " €     *");
        System.out.println("***********************************");
        System.out.println("*  Juomat:                        *");
        System.out.println("*  Iso juoma: " + f + " €               *");
        System.out.println("*  Pieni juoma: " + g + " €             *");
        System.out.println("***********************************");
    }   
    static int isojenBmaara()
    {   
        Scanner lukija = new Scanner(System.in);
        System.out.print("Kuinka monta isoa burgeria saisi olla? ");
        int z;
        z = lukija.nextInt();
        return z;
    }
    static int mediumBmaara()
    {   
        Scanner lukija = new Scanner(System.in);
        System.out.print("Kuinka monta medium burgeria saisi olla? ");
        int z;
        z = lukija.nextInt();
        return z;
    }
    static int pienienBmaara()
    {   
        Scanner lukija = new Scanner(System.in);
        System.out.print("Kuinka monta pientä burgeria saisi olla? ");
        int z;
        z = lukija.nextInt();
        return z;
    }
    static int isojenRmaara()
    {   
        Scanner lukija = new Scanner(System.in);
        System.out.print("Kuinka monet isot ranskalaiset saisi olla? ");
        int z;
        z = lukija.nextInt();
        return z;
    }
    static int pienienRmaara()
    {   
        Scanner lukija = new Scanner(System.in);
        System.out.print("Kuinka monet pienet ranskalaiset saisi olla? ");
        int z;
        z = lukija.nextInt();
        return z;
    }
    static int isojenJmaara()
    {   
        Scanner lukija = new Scanner(System.in);
        System.out.print("Kuinka monta isoa juomaa saisi olla? ");
        int z;
        z = lukija.nextInt();
        return z;
    }
    static int pienienJmaara()
    {   
        Scanner lukija = new Scanner(System.in);
        System.out.print("Kuinka monta pientä juomaa saisi olla? ");
        int z;
        z = lukija.nextInt();
        return z;
    }
    static double laskeNumerot(int a, int b, int c, int d, int e, int f, int g, double h, double i, double j, double k, double l, double m, double n, double o)
    {
        double x;
        x = (o*((a*h) + (b*i) + (c*j) + (d*k) + (e*l) + (f*m) + (g*n)));
        return x;
    }
}
