package dothegee2;

import java.awt.Cursor;
import java.awt.Image;
import java.awt.Point;
import java.awt.Toolkit;

import javax.swing.JFrame;

public class MyFrame extends JFrame{

	MainPanel mp;
	GamePanel gp;
	SoloGamePanel SP;
	ap	AP;
	String IP;
	
	Thread mainThread;
	Toolkit tk = Toolkit.getDefaultToolkit();
	Image img = tk.getImage("hammer.png");
	Cursor myCursor = tk.createCustomCursor(img, new Point(10,10),"dynamite stick");
	public MyFrame(String IP) {
		this.IP = IP;
		
		mp = new MainPanel();
		gp = new GamePanel(IP);
		SP = new SoloGamePanel();
		
		this.setTitle("두더지");
		this.setSize(960,600);
		this.setVisible(true);
		this.add(mp);
		this.setCursor(myCursor);
		mainThread = mp.threadMake();
		mainThread.start();
		
		while(true) {
			if(mp.start == 1) {	  // 메인패널에서 패스워드 만들기 버튼을 클릭하면 일어나는 이벤트 
				this.getContentPane().remove(mp);  // 메인패널을 보이지 않게 하고
				this.getContentPane().add(gp);   // 패스워드 만들기 패널을 보이게 함
				mainThread.interrupt();
				mp.count = 0;
				this.validate();
				repaint(); // 다시칠하기
				mp.start = 0;  // 화면 전환하

		}
			if(mp.soloStart == 1) {	  // 메인패널에서 패스워드 만들기 버튼을 클릭하면 일어나는 이벤트 
				this.getContentPane().remove(mp);  // 메인패널을 보이지 않게 하고
				this.getContentPane().add(SP);   // 패스워드 만들기 패널을 보이게 함
				mainThread.interrupt();
				mp.count = 0;
				this.validate();
				repaint(); // 다시칠하기
				mp.soloStart = 0;  // 화면 전환하

		}
			if(gp.back == 1) {	  // 메인패널에서 패스워드 만들기 버튼을 클릭하면 일어나는 이벤트 
				this.getContentPane().remove(gp);  // 메인패널을 보이지 않게 하고
				this.getContentPane().add(mp);   // 패스워드 만들기 패널을 보이게 함
				mainThread = mp.threadMake();
				mp.count = 12;
				mainThread.start();
				this.validate();
				repaint(); // 다시칠하기
				gp.back = 0;  // 화면 전환하
			}
			if(SP.back == 1) {	  // 메인패널에서 패스워드 만들기 버튼을 클릭하면 일어나는 이벤트 
				this.getContentPane().remove(SP);  // 메인패널을 보이지 않게 하고
				this.getContentPane().add(mp);   // 패스워드 만들기 패널을 보이게 함
				mainThread = mp.threadMake();
				mp.count = 12;
				mainThread.start();
				this.validate();
				repaint(); // 다시칠하기
				SP.back = 0;  // 화면 전환하
			}
			try {Thread.sleep(500);
		}catch(Exception e) {}
	}
}


	
}
