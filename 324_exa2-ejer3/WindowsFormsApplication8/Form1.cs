using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

using System.IO;
using System.Runtime.Serialization.Formatters.Binary;
namespace WindowsFormsApplication8
{
    public partial class Form1 : Form
    {
        
        
        const string FileName = @"D:/SavedData.dat";

        Bitmap bmp;
        Bitmap bmpR;
        int pR, pG, pB;
        int contadorPuntos = 0;
        int[] punto1 = new int[3];
        int[] punto2 = new int[3];
        int[] punto3 = new int[3];

        private Dictionary<string, ImagenG> ImagenesDictionary;
        private BinaryFormatter formatter;
        public Form1()
        {
            InitializeComponent();

            this.ImagenesDictionary = new Dictionary<string, ImagenG>();
            this.formatter = new BinaryFormatter();
            Load();
        }
        public void agregarImagen()
        {
            puntoRGB prgb1 = new puntoRGB(punto1[0], punto1[1], punto1[2]);
            puntoRGB prgb2 = new puntoRGB(punto2[0], punto2[1], punto2[2]);
            puntoRGB prgb3 = new puntoRGB(punto3[0], punto3[1], punto3[2]);                        
            this.ImagenesDictionary.Add(textBox4.Text, new ImagenG(bmp, bmpR, prgb1, prgb2, prgb3));
            guardarArchivo();
        }
        public void Load()
        {
            if (File.Exists(FileName))
            {
                try
                {
                    FileStream readerFileStream = new FileStream(FileName,
                        FileMode.Open, FileAccess.Read);
                    this.ImagenesDictionary = (Dictionary<String, ImagenG>)
                        this.formatter.Deserialize(readerFileStream);
                    readerFileStream.Close();

                }
                catch (Exception)
                {
                    Console.WriteLine("error al leer");
                }
            }
        }

        private void guardarArchivo()
        {
            try
            {                
                FileStream writerFileStream = new FileStream(FileName, FileMode.Create, FileAccess.Write);
                this.formatter.Serialize(writerFileStream, this.ImagenesDictionary);              
                writerFileStream.Close();
            }
            catch (Exception)
            {
                Console.WriteLine("error al guardar");
            }
        }       

        private void pictureBox1_MouseClick(object sender, MouseEventArgs e)
        {
            Color c = new Color();            
            pR = 0;
            pG = 0;
            pB = 0;
            for (int ki = e.X; ki < e.X + 10; ki++)
                for (int kj = e.Y; kj < e.Y + 10; kj++)
                {
                    c = bmp.GetPixel(ki, kj);
                    pR = pR + c.R;
                    pG = pG + c.G;
                    pB = pB + c.B;
                }
            pR = pR / 100;
            pG = pG / 100;
            pB = pB / 100;
            textBox1.Text = c.R.ToString();
            textBox2.Text = c.G.ToString();
            textBox3.Text = c.B.ToString();
        }
        
        public void CargarImagenGuardada(object sender, EventArgs e) {
            ImagenG iaux = ImagenesDictionary[textBox5.Text];
            bmp = new Bitmap(iaux.btmImagenOriginal);
            pictureBox1.Image = bmp;
            bmpR = new Bitmap(iaux.btmImagenCambiada);
            pictureBox2.Image = bmpR;
            contadorPuntos = 0;
            textBox6.Text = "Fuchsia: " + "R=" + iaux.puntos[0].R + " G=" + iaux.puntos[0].G + " B=" + iaux.puntos[0].B + "\r\n" +
                "Cyan: " + "R=" + iaux.puntos[1].R + " G=" + iaux.puntos[1].G + " B=" + iaux.puntos[1].B + "\r\n" +
                "Coral: " + "R=" + iaux.puntos[2].R + " G=" + iaux.puntos[2].G + " B=" + iaux.puntos[2].B + "\r\n";
        }

        private void GuardarImagen(object sender, EventArgs e)
        {
            agregarImagen();
            guardarArchivo();
        }

        private void cambiar10x10(object sender, EventArgs e)
        {
            int mR = 0, mG = 0, mB = 0;
            Color c = new Color();

            for (int i = 0; i < bmp.Width - 10; i = i + 10)
                for (int j = 0; j < bmp.Height - 10; j = j + 10)
                {
                    mR = 0;
                    mG = 0;
                    mB = 0;
                    for (int ki = i; ki < i + 10; ki++)
                        for (int kj = j; kj < j + 10; kj++)
                        {
                            c = bmp.GetPixel(ki, kj);
                            mR = mR + c.R;
                            mG = mG + c.G;
                            mB = mB + c.B;
                        }
                    mR = mR / 100;
                    mG = mG / 100;
                    mB = mB / 100;

                    c = bmp.GetPixel(i, j);
                    if ((pR - 5 <= mR && mR <= pR + 5) && (pG - 5 <= mG && mG <= pG + 5) && (pB - 5 <= mB && mB <= pB + 5))
                    {
                        for (int ki = i; ki < i + 10; ki++)
                            for (int kj = j; kj < j + 10; kj++)
                            {
                                switch (contadorPuntos)
                                {
                                    case 0:
                                        bmpR.SetPixel(ki, kj, Color.Fuchsia);
                                        punto1[0] = pR;
                                        punto1[1] = pG;
                                        punto1[2] = pB;
                                        break;
                                    case 1:
                                        bmpR.SetPixel(ki, kj, Color.Cyan);
                                        punto2[0] = pR;
                                        punto2[1] = pG;
                                        punto2[2] = pB;
                                        break;
                                    case 2:
                                        bmpR.SetPixel(ki, kj, Color.Coral);
                                        punto3[0] = pR;
                                        punto3[1] = pG;
                                        punto3[2] = pB;
                                        break;
                                    default:

                                        break;
                                }
                            }
                    }
                    else
                    {
                        for (int ki = i; ki < i + 10; ki++)
                            for (int kj = j; kj < j + 10; kj++)
                            {
                                c = bmpR.GetPixel(ki, kj);
                                bmpR.SetPixel(ki, kj, Color.FromArgb(c.R, c.G, c.B));
                            }
                    }
                }

            pictureBox2.Image = bmpR;
            contadorPuntos++;
        }

        private void cargarImagenNueva(object sender, EventArgs e)
        {
            openFileDialog1.Filter = "Todos *.*|";
            openFileDialog1.ShowDialog();
            bmp = new Bitmap(openFileDialog1.FileName);
            pictureBox1.Image = bmp;
            bmpR = (Bitmap)bmp.Clone();
            pictureBox2.Image = bmpR;
            contadorPuntos = 0;
        }
    }
}

