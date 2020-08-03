package dothegee2;

import java.awt.Graphics;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.image.BufferedImage;
import java.io.BufferedReader;
import java.io.File;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.PrintWriter;
import java.net.Socket;
import java.net.UnknownHostException;

import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;
import javax.swing.JTextField;

public class GamePanel extends JPanel implements ActionListener, Runnable{

	JButton dothegee[];
	int score = 0;
	int time = 0;
	int up[] = new int[16];
	Thread thread[] = new Thread[16];
	Thread startInputThread;
	Thread startOutputThread;
	Thread chatThread;
	
	JButton startButton;
	int start = 0;

	
	int r1,r2;
	int clickScore[] = new int[16];
	int otherScore;
	int back;
	
	Socket chatServer;
	Socket inputServer;
	Socket outputServer;
	BufferedReader inputbr;
	PrintWriter inputpw;
	BufferedReader outputbr;
	PrintWriter outputpw;
	BufferedReader chatbr;
	PrintWriter chatpw;
	String IP;
	
	JTextField otherScoreField;
	JTextField chatField;
	JTextField scoreBoard;
	JButton chatButton;
	JTextArea chatArea;
	JButton backButton;

	JScrollPane scrollPane;
	ImageIcon image = new ImageIcon("dothegee.png");
	

	BufferedImage backImgae;

	public GamePanel(String IP) {
		
		try {
			backImgae = ImageIO.read(new File("back.jpg"));
			
		}catch(Exception e) {}
		this.IP = IP;
		chatArea = new JTextArea(50,50);
		chatArea.setText("환영합니다." + "\n");
		scrollPane = new JScrollPane(chatArea);
		
		otherScoreField = new JTextField(40);

		chatField = new JTextField(40);
		scoreBoard = new JTextField(40);
		scoreBoard.setText("내 점수 : ");
		otherScoreField.setText("상대 점수 : ");
		
		backButton = new JButton("뒤로가기");
		chatButton = new JButton("보내기");	
		dothegee = new JButton[16];
		startButton = new JButton("시작하기");


		this.setLayout(null);


		startButton.setBounds(50,475,200,50);
		backButton.setBounds(275,475,200,50);
		
		scoreBoard.setBounds(550,50,125,30);
		scrollPane.setBounds(550,150,350,300);
		chatField.setBounds(550,475,250,50);
		chatButton.setBounds(820,475,80,50);
		otherScoreField.setBounds(550,100,125,30);

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
				start = 0;
				scoreBoard.setText("내 점수 : ");
				otherScoreField.setText("상대 점수 : ");
				chatArea.setText("환영합니다. " + "\n");
				score = 0;
			}
			back = 1;
			chatArea.setText("환영합니다. " + "\n");
		});
		
		chatField.addActionListener(e->{
			chatpw.println(chatField.getText());
			chatpw.flush();
			chatField.setText("");

		});
		
		chatButton.addActionListener(e->{
			chatpw.println(chatField.getText());
			chatpw.flush();
			chatField.setText("");		
		});
		startButton.addActionListener(e->{
			if(start == 0) {
				try {   // input이 난수생성 OUTPUT이 클릭했을때 서버에 보내는거 

					inputServer = new Socket(IP,10000);
					inputbr = new BufferedReader(new InputStreamReader(inputServer.getInputStream()));
					inputpw = new PrintWriter(new OutputStreamWriter(inputServer.getOutputStream()));
					outputServer = new Socket(IP,11000);
					outputbr = new BufferedReader(new InputStreamReader(outputServer.getInputStream()));
					outputpw = new PrintWriter(new OutputStreamWriter(outputServer.getOutputStream()));
					chatServer = new Socket(IP,12000);
					chatbr = new BufferedReader(new InputStreamReader(chatServer.getInputStream()));
					chatpw = new PrintWriter(new OutputStreamWriter(chatServer.getOutputStream()));
				} catch (UnknownHostException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				} catch (IOException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				}
			start = 1;
			startInputThread = new Thread(this);
			startInputThread.start();
			startOutputThread = new Thread(new OutputServerThread());
			startOutputThread.start();
			chatThread = new Thread(new ChatServerThread());
			chatThread.start();

			}
		});
		this.add(startButton);
		this.add(scoreBoard);
		this.add(scrollPane);
		this.add(chatField);
		this.add(chatButton);
		this.add(otherScoreField);
		this.add(backButton);
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		for(int i = 0; i <  16; i++) {
			if(e.getSource() == dothegee[i]) {
				outputpw.println(i + "");
				outputpw.flush();
				score  = score + clickScore[i];
				scoreBoard.setText("내 점수 : " + score);
				outputpw.println("상대 점수 : " + score);
				outputpw.flush();
			}
			
		}
		
	}
	

		public void run() {    // 서버에서 난수 받아서 올라가게 해주는 코드 
			String s;
				try {
					s = inputbr.readLine();
					chatArea.append(s + "\n");
					s = inputbr.readLine();
					chatArea.append(s + "\n");
					s = inputbr.readLine();
					chatArea.append(s + "\n");
					while(true) {
						s = inputbr.readLine();
						if(s.equals("quit")) {break;}
						else{r1 = Integer.parseInt(s);
						s = inputbr.readLine();
						r2 = Integer.parseInt(s);
						if(r2 > 2900) clickScore[r1] =2;   //2.5초이상    5점 ~15점 획득
						else if (r2 > 2800)  clickScore[r1] = 4;  //1.5~2초   20~25점 획득
						else if(r2 > 2700) clickScore[r1] = 6;  //1초~1.5초   40 ~ 42점획득
						else if(r2 > 2600) clickScore[r1] = 8;  // 0.75~1초      58~60잠 획득
						else if(r2 > 2500)	clickScore[r1]  = 10; // 0.5 ~ 0.75초   약 80획득
						else if(r2 > 2400) clickScore[r1] = 12;  // 0.4~0.5초        125점정도 획득
						else if(r2 > 2300) clickScore[r1] = 14;  // 0.3~0.4초  약 200점 획득
						else if(r2 > 2200) clickScore[r1] = 16;  // 0.2~0.3초 약 350점 획득
						else if(r2 > 2100) clickScore[r1] = 18;    // 0.15~0.2초 약 550점
						else if(r2 > 2000) clickScore[r1] = 20; 
						else if(r2 > 1900) clickScore[r1] = 25; 
						else if (r2 > 1800)  clickScore[r1] = 30;  //1.5~2초   20~25점 획득
						else if(r2 > 1700) clickScore[r1] = 35;  //1초~1.5초   40 ~ 42점획득
						else if(r2 > 1600) clickScore[r1] = 40;  // 0.75~1초      58~60잠 획득
						else if(r2 > 1500)	clickScore[r1]  = 45; // 0.5 ~ 0.75초   약 80획득
						else if(r2 > 1400) clickScore[r1] = 50;  // 0.4~0.5초        125점정도 획득
						else if(r2 > 1300) clickScore[r1] = 55;  // 0.3~0.4초  약 200점 획득
						else if(r2 > 1200) clickScore[r1] = 60;  // 0.2~0.3초 약 350점 획득
						else if(r2 > 1100) clickScore[r1] = 65;    // 0.15~0.2초 약 550점
						else if(r2 > 1000) clickScore[r1] = 70; 
						else if(r2 > 900) clickScore[r1] = 80; 
						else if (r2 > 800)  clickScore[r1] = 90;  //1.5~2초   20~25점 획득
						else if(r2 > 700) clickScore[r1] = 100;  //1초~1.5초   40 ~ 42점획득
						else if(r2 > 600) clickScore[r1] = 125;  // 0.75~1초      58~60잠 획득
						else if(r2 > 500)	clickScore[r1]  = 150; // 0.5 ~ 0.75초   약 80획득
						else if(r2 > 400) clickScore[r1] = 250;  // 0.4~0.5초        125점정도 획득
						else if(r2 > 300) clickScore[r1] = 400;  // 0.3~0.4초  약 200점 획득
						else if(r2 > 250) clickScore[r1] = 600;  // 0.2~0.3초 약 350점 획득
						else if(r2 > 200) clickScore[r1] = 900;    // 0.15~0.2초 약 550점
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
					}
					}
					inputpw.println(score + "");
					inputpw.flush();
					s = inputbr.readLine();
					chatArea.append(s + "\n");
					
					scoreBoard.setText("내 점수 : ");
					otherScoreField.setText("상대 점수 : ");
					
					
				} catch (IOException e) {
					
				}	
			score = 0;
			start = 0;
		}
	
	class OutputServerThread extends Thread{    //클릭하면 사라지는 위치 받아서 사라지게하고 점수 올리는 쓰레드 
		
		String s;
		
		public void run() {
			try {
			while(start != 0) {
				s = outputbr.readLine();
				if(s.startsWith("상대 점수 : ")) {
					otherScoreField.setText(s + "");
					repaint();
				}
				else {
					int a = Integer.parseInt(s);
					dothegee[a].setVisible(false);
		 			up[a] = 0;
					GamePanel g = new GamePanel(IP);
					g.stop(thread[a]);

					repaint();
				}
			}
			}catch(Exception e) {
				
			}
		}

	}
	
	public Thread start(int w,int t, Thread th) {
		return new MyThread(t,w);
		

	}
	
	public void stop(Thread th) {
		th.interrupt();
	}
	
	public class ChatServerThread extends Thread{
		String s;
		public void run() {
			try {
			while(start != 0) {
				s = chatbr.readLine();
				chatArea.append(s + "\n");
			}
			}catch(Exception e) {	
			}
		}
		

		
		
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
