using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Text.RegularExpressions;

using Microsoft.Win32;
using Microsoft.VisualBasic;

namespace Appi
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void dateTimePicker4_ValueChanged(object sender, EventArgs e)
        {

            RegistryKey ke = Registry.LocalMachine;
            RegistryKey key = ke.OpenSubKey("System\\CurrentControlSet\\Services\\SharedAccess\\Parameters\\FirewallPolicy\\FirewallRules");
            Array key2 = key.GetSubKeyNames();
            Array name = key.GetValueNames();



            dataGridView1.ColumnCount = 0;
            DataGridViewCheckBoxColumn c = new DataGridViewCheckBoxColumn();
            c.HeaderText = "Select";
            dataGridView1.Columns.Add(c);
            dataGridView1.Columns.Add("joo", "tieto 1");
            dataGridView1.Columns.Add("joo2", "tieto 2");
            dataGridView1.Columns.Add("joo3", "tieto 3");
            dataGridView1.Columns.Add("joo4", "tieto 4");
            dataGridView1.Columns.Add("joo5", "tieto 5");
            dataGridView1.Columns.Add("joo6", "tieto 6");
            dataGridView1.Columns.Add("joo7", "tieto 7");
            dataGridView1.Columns.Add("joo8", "tieto 8");


            for (int i=0; i<name.Length; i++)
	       {
               String j = (string)name.GetValue(i);
               String k = (string)key.GetValue(j);

                Array kk = k.Split('|');
                Array k2 = (Array)k.Split('|');

                dataGridView1.Rows.Add(false,
                                        name.GetValue(i),
                    
                                        k2.GetValue(0),
                                        k2.GetValue(1),
                                        k2.GetValue(2), // 4
                
                                        k2.GetValue(3),
                                        k2.GetValue(4),
                
                                        k2.GetValue(5),
                                        k2.GetValue(6) // 8
                      );

	       }
            
            

        }

    }
}
