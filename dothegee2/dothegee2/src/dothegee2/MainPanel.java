package dothegee2;

import java.awt.Font;
import java.awt.Graphics;
import java.awt.image.BufferedImage;
import java.io.File;

import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JPanel;

public class MainPanel extends JPanel{
	
	JButton soloStartButton;
	JButton startButton;
	JButton exitButton;
	
	int start = 0;
	int soloStart = 0;
	
	
	JLabel main1;
	JLabel main2;
	JLabel main3;
	JLabel main4;
	JLabel main5;
	JLabel main6;
	JLabel main7;
	JLabel main8;
	JLabel main9;
	
	ImageIcon attack = new ImageIcon("attack2.png");
	ImageIcon normal = new ImageIcon("normal.png");
	ImageIcon hammer150 = new ImageIcon("hammer150.png");
	ImageIcon shock = new ImageIcon("shock.png");
	int count = 0;
	
	

	BufferedImage backImgae;
	
	Font font = new Font("Serif",Font.BOLD,50);
	

	public MainPanel() {
		try {
			backImgae = ImageIO.read(new File("back.jpg"));
			
		}catch(Exception e) {}		



		main1 = new JLabel("두");
		main2 = new JLabel("더");
		main3 = new JLabel("지");
		main4 = new JLabel("잡");
		main5 = new JLabel("기");
		main6 = new JLabel(normal);
		main7 = new JLabel(hammer150);
		main8 = new JLabel(shock);
		main9 = new JLabel(attack);
		
		
		main1.setFont(font);
		main2.setFont(font);
		main3.setFont(font);
		main4.setFont(font);
		main5.setFont(font);

		main1.setBounds(250,100,70,70);
		main2.setBounds(350,100,70,70);
		main3.setBounds(450,100,70,70);
		main4.setBounds(550,100,70,70);
		main5.setBounds(650,100,70,70);
		
		
		
		main7.setBounds(750,250,150,150);
		main8.setBounds(650,260,100,100);
		main9.setBounds(555,350,200,200);
		main6.setBounds(555,350,200,200);	
		
		
		main1.setVisible(false);
		main2.setVisible(false);
		main3.setVisible(false);
		main4.setVisible(false);
		main5.setVisible(false);
		main6.setVisible(false);
		main7.setVisible(false);
		main8.setVisible(false);
		main9.setVisible(false);
		
		
		this.setLayout(null);
		startButton = new JButton("멀티플레이");
		exitButton = new JButton("종료하기");
		soloStartButton = new JButton("싱글플레이");
		startButton.setBounds(380,250,100,50);
		exitButton.setBounds(500,250,100,50);
		soloStartButton.setBounds(260,250,100,50);
		
		soloStartButton.addActionListener(e->{
			
			
			soloStart = 1;
			
		});
		
		
		startButton.addActionListener(e->{
			
			start = 1;
		});
		
		exitButton.addActionListener(e->{
			
			System.exit(0);
		});
		
		this.add(startButton);
		this.add(exitButton);
		this.add(soloStartButton);
		this.add(main1);
		this.add(main2);
		this.add(main3);
		this.add(main4);
		this.add(main5);
		this.add(main6);
		this.add(main7);
		this.add(main8);
		this.add(main9);
	}
	
	
	
	public void paintComponent(Graphics g) {
		super.paintComponent(g);
		g.drawImage(backImgae,0,0,null);
		repaint();
		
		
	}
	
	public Thread threadMake() {
		return new Thread(new MyThread());
	}
	
	public void threadStop(Thread t) {
		t.interrupt();
	}
	
	class MyThread extends Thread{
		
		
	
		public void run() {
			try {
				while(true) {
					count++;
					if(count == 1) {
						main1.setVisible(true);
					}
					else if(count == 2) {
						main2.setVisible(true);
					}
					else if(count == 3) {
						main3.setVisible(true);
					}
					else if(count == 4) {
						main4.setVisible(true);
					}
					else if(count == 5) {
						main5.setVisible(true);
					}
					else if(count == 6) {
						main6.setVisible(true);

					}
					else if(count == 7) {
						main7.setBounds(800,200,150,150);
						main7.setVisible(true);
						Thread.sleep(100);
						continue;
					}
					else if(count == 8) {
						main7.setBounds(775,225,150,150);
						Thread.sleep(100);
						continue;
					}
					else if(count == 9) {
						main7.setBounds(750,250,150,150);
						Thread.sleep(100);
						continue;
					}
					else if(count == 10) {
						main8.setVisible(true);
						Thread.sleep(100);
						continue;
					}
					else if(count == 11) {
						main6.setVisible(false);
						main9.setVisible(true);
					}
					else if(count == 12) {
					    Thread.sleep(2500);
						main1.setVisible(false);
						main2.setVisible(false);
						main3.setVisible(false);
						main4.setVisible(false);
						main5.setVisible(false);
						main6.setVisible(false);
						main7.setVisible(false);
						main8.setVisible(false);
						main9.setVisible(false);
						continue;
					}
					else if(count == 13) {
						main1.setVisible(false);
						main2.setVisible(false);
						main3.setVisible(false);
						main4.setVisible(false);
						main5.setVisible(false);
						main6.setVisible(false);
						main7.setVisible(false);
						main8.setVisible(false);
						main9.setVisible(false);
						count = 0;
					}
					Thread.sleep(500);
				}
			}catch(Exception e) {}
		}
		
}
	
	
}
