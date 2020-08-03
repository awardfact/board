package dothegee2;

import java.awt.Graphics;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.image.BufferedImage;
import java.io.File;

import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;
import javax.swing.JTextField;

public class SoloGamePanel extends JPanel implements ActionListener, Runnable{

	
	
	JTextArea chatArea;
	JButton dothegee[];
	int score = 0;
	int time = 0;
	int up[] = new int[16];
	Thread thread[] = new Thread[16];
	Thread startThread;
	JButton startButton;
	int start = 0;
	int r1,r2;
	int clickScore[] = new int[16];
	int otherScore;
	int back = 0;

	JScrollPane scrollPane;

	BufferedImage backImgae;


	JButton backButton;
	JTextField scoreBoard;
	ImageIcon image = new ImageIcon("dothegee.png");
	

	
	public SoloGamePanel() {
		try {
			backImgae = ImageIO.read(new File("back.jpg"));
			
		}catch(Exception e) {}		


		scoreBoard = new JTextField(40);
		chatArea = new JTextArea(50,50);
		scrollPane = new JScrollPane(chatArea);

		dothegee = new JButton[16];

		backButton = new JButton("µÚ·Î°¡±â");
		startButton = new JButton("½ÃÀÛÇÏ±â");


		this.setLayout(null);


		startButton.setBounds(50,475,200,50);
		scrollPane.setBounds(550,150,350,300);
		backButton.setBounds(275,475,200,50);
		scoreBoard.setBounds(550,50,125,30);


		
		
		
		for(int i = 0; i < 16; i++) {	
			dothegee[i]  = new JButton(image);
			dothegee[i].addActionListener(this);
			dothegee[i].setBounds(((((i) % 4) * 100) + 100)-50,((((i) / 4) * 100)+ 100)-50,80,80);
			this.add(dothegee[i]);
			dothegee[i].setVisible(false);
			dothegee[i].setBorderPainted(false);
			dothegee[i].setContentAreaFilled(false);
			dothegee[i].setFocusPainted(false);
		}

		backButton.addActionListener(e->{
			if(start == 1) {
		
				startThread.interrupt();
				start = 0;
			}
			scoreBoard.setText("Á¡¼ö : ");
			back = 1;
			
		});
		
		startButton.addActionListener(e->{
			if(start == 0) {
				score = 0;
			startThread = new Thread(this);
			startThread.start();
			start = 1;
			}
		});
		this.add(startButton);
		this.add(scoreBoard);
		this.add(backButton);
		this.add(scrollPane);
	}

		
		
		
	
public void actionPerformed(ActionEvent e) {
	for(int i = 0; i <  16; i++) {
		if(e.getSource() == dothegee[i]) {
			dothegee[i].setVisible(false);
			score += clickScore[i];
			up[i] = 0;
			stop(thread[i]);
			scoreBoard.setText("Á¡¼ö : " + score);
		}
		
	}
	
}


	public void run() {
		try{
		chatArea.append("3ÃÊµÚ¿¡ ½ÃÀÛÇÕ´Ï´Ù" + "\n");
		Thread.sleep(1000);
		chatArea.append("2ÃÊµÚ¿¡ ½ÃÀÛÇÕ´Ï´Ù" + "\n");
		Thread.sleep(1000);
		chatArea.append("1ÃÊµÚ¿¡ ½ÃÀÛÇÕ´Ï´Ù" + "\n");
		Thread.sleep(1000);
		
		while(time < 180) {
			int r1 = (int) (Math.random() * 16);
			int r2 = (int) (Math.random() * 3000);
			if(r2 > 2900) clickScore[r1] =2;   //2.5ÃÊÀÌ»ó    5Á¡ ~15Á¡ È¹µæ
			else if (r2 > 2800)  clickScore[r1] = 4;  //1.5~2ÃÊ   20~25Á¡ È¹µæ
			else if(r2 > 2700) clickScore[r1] = 6;  //1ÃÊ~1.5ÃÊ   40 ~ 42Á¡È¹µæ
			else if(r2 > 2600) clickScore[r1] = 8;  // 0.75~1ÃÊ      58~60Àá È¹µæ
			else if(r2 > 2500)	clickScore[r1]  = 10; // 0.5 ~ 0.75ÃÊ   ¾à 80È¹µæ
			else if(r2 > 2400) clickScore[r1] = 12;  // 0.4~0.5ÃÊ        125Á¡Á¤µµ È¹µæ
			else if(r2 > 2300) clickScore[r1] = 14;  // 0.3~0.4ÃÊ  ¾à 200Á¡ È¹µæ
			else if(r2 > 2200) clickScore[r1] = 16;  // 0.2~0.3ÃÊ ¾à 350Á¡ È¹µæ
			else if(r2 > 2100) clickScore[r1] = 18;    // 0.15~0.2ÃÊ ¾à 550Á¡
			else if(r2 > 2000) clickScore[r1] = 20; 
			else if(r2 > 1900) clickScore[r1] = 25; 
			else if (r2 > 1800)  clickScore[r1] = 30;  //1.5~2ÃÊ   20~25Á¡ È¹µæ
			else if(r2 > 1700) clickScore[r1] = 35;  //1ÃÊ~1.5ÃÊ   40 ~ 42Á¡È¹µæ
			else if(r2 > 1600) clickScore[r1] = 40;  // 0.75~1ÃÊ      58~60Àá È¹µæ
			else if(r2 > 1500)	clickScore[r1]  = 45; // 0.5 ~ 0.75ÃÊ   ¾à 80È¹µæ
			else if(r2 > 1400) clickScore[r1] = 50;  // 0.4~0.5ÃÊ        125Á¡Á¤µµ È¹µæ
			else if(r2 > 1300) clickScore[r1] = 55;  // 0.3~0.4ÃÊ  ¾à 200Á¡ È¹µæ
			else if(r2 > 1200) clickScore[r1] = 60;  // 0.2~0.3ÃÊ ¾à 350Á¡ È¹µæ
			else if(r2 > 1100) clickScore[r1] = 65;    // 0.15~0.2ÃÊ ¾à 550Á¡
			else if(r2 > 1000) clickScore[r1] = 70; 
			else if(r2 > 900) clickScore[r1] = 80; 
			else if (r2 > 800)  clickScore[r1] = 90;  //1.5~2ÃÊ   20~25Á¡ È¹µæ
			else if(r2 > 700) clickScore[r1] = 100;  //1ÃÊ~1.5ÃÊ   40 ~ 42Á¡È¹µæ
			else if(r2 > 600) clickScore[r1] = 125;  // 0.75~1ÃÊ      58~60Àá È¹µæ
			else if(r2 > 500)	clickScore[r1]  = 150; // 0.5 ~ 0.75ÃÊ   ¾à 80È¹µæ
			else if(r2 > 400) clickScore[r1] = 250;  // 0.4~0.5ÃÊ        125Á¡Á¤µµ È¹µæ
			else if(r2 > 300) clickScore[r1] = 400;  // 0.3~0.4ÃÊ  ¾à 200Á¡ È¹µæ
			else if(r2 > 250) clickScore[r1] = 600;  // 0.2~0.3ÃÊ ¾à 350Á¡ È¹µæ
			else if(r2 > 200) clickScore[r1] = 900;    // 0.15~0.2ÃÊ ¾à 550Á¡
			else if(r2 > 150) clickScore[r1] = 1300; 
			else if(r2 > 100) clickScore[r1] = 1800; 
			else if(r2 > 75) clickScore[r1] = 2500; 
			else if(r2 > 50) clickScore[r1] = 3500; 
			else if(r2 > 25) clickScore[r1] = 5000; 
			else if(r2 > 0) clickScore[r1] = 10000; 
			if(up[r1] == 0) {
				thread[r1] = start(r1,r2,thread[r1]);
				thread[r1].start();
			}
			Thread.sleep(333);
			time++;
		}
		}catch(Exception ee) {}
		chatArea.append("´ç½ÅÀÇ Á¡¼ö´Â : " + score + " ÀÔ´Ï´Ù \n");
		score = 0;
		time = 0;
		start = 0;
	}
	



public Thread start(int w,int t, Thread th) {
	return new MyThread(t,w);
	

}

public void stop(Thread th) {
	th.interrupt();
}



public class MyThread extends Thread{
	
	int time2;
	int when2;
	
	public MyThread(int time2, int when2) {
		this.time2 = time2;
		this.when2 = when2;
		
	}
	
	public void run() {
		if(up[when2] == 0) {
			dothegee[when2].setVisible(true);
			up[when2] = 1;
			try {
				Thread.sleep(time2);
				dothegee[when2].setVisible(false);
				up[when2]  = 0;
			}catch(Exception e){}
		}
	}
}



public void paintComponent(Graphics g) {
	super.paintComponent(g);
	g.drawImage(backImgae,0,0,null);
	repaint();
	
	
}



}

