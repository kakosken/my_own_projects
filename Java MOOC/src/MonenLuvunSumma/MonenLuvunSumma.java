/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package MonenLuvunSumma;

/**
 *
 * @author rivetech
 */
public class MonenLuvunSumma {
    public static void main(String[] args) {
        
        int eka = 3;
        int toka = 2;
        
        int monenLuvunSumma = summa(summa(1, 2), summa(eka, toka));
        
        System.out.println("Summa: " + monenLuvunSumma);        
        
    }
    public static int summa(int luku1, int luku2) {
    return luku1+luku2;
}
    
}
