/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
import java.util.*;
/**
 *
 * @author rivetech
 */
public class TotallyRandom 
{
    public static void main(String[] args)
    {
    
        int a = noppa();
        int b = noppaKaksi();
        noppa();
        noppaKaksi();
        
                
        System.out.println("Noppa yksi: " + a);
        System.out.println("Noppa kaksi: " + b);
    }
    public static int noppa()
    {
        Random random = new Random();
        int z = random.nextInt(6) + 1;
        return z;
    }
    public static int noppaKaksi()
    {
        Random random = new Random();
        int p = random.nextInt(6) + 1;
        return p;
    }

}
