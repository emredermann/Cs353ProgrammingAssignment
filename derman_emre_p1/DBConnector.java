import java.sql.*;

public class DBConnector {

	public static void main(String[] args) {

		try {
				Class.forName("com.mysql.cj.jdbc.Driver");
		}catch(ClassNotFoundException e) {
			System.out.println("MySQL JDBC Driver not found");
			e.printStackTrace();
		}
		final String USERNAME="emre.derman";
		final String PASSWORD="Gty1Mlp7";
		final String DBNAME="emre_derman";
		final String URL="jdbc:mysql://dijkstra.ug.bcc.bilkent.edu.tr/"+DBNAME;
		Connection connection = null; 
		
		try {
			connection = DriverManager.getConnection(URL,USERNAME,PASSWORD);
		} catch (SQLException e) {
			System.out.println("Connection Failed.");
			e.printStackTrace();
		}
		if(connection != null) {
			System.out.println("Conection established");
		}else {
			System.out.println("Connection failed to establishment.");
		}
		
		Statement stmt;
		try {
			stmt = connection.createStatement();
			System.out.println("Dropping tables student, company, apply..");
			
			stmt.executeUpdate("DROP TABLE IF EXISTS apply;");
			
			stmt.executeUpdate("DROP TABLE IF EXISTS company;");
			
			stmt.executeUpdate("DROP TABLE IF EXISTS student;");
	
			System.out.println("Dropping tables student, company, apply has been done succesfuly.");
			
			System.out.println("Creating table student...");
			stmt.executeUpdate("CREATE TABLE student("+
				"sid CHAR(12),"+
				"sname VARCHAR(50),"+
				"bdate DATE,"+
				"address VARCHAR(50),"+
				"scity VARCHAR(20),"+
				"year CHAR(20),"+
				"gpa FLOAT,"+
				"nationality VARCHAR(20),"+
				"PRIMARY KEY(sid))"+
				"ENGINE=innodb;"
			);
			System.out.println("Student table has been created successfully.");

			System.out.println("Creating table company...");
			
			stmt.executeUpdate("CREATE TABLE company ("+
			"cid CHAR(8),"+
			"cname VARCHAR(20),"+
			"quota INT ,"+
		//	"FOREIGN KEY(cid), "+
			"PRIMARY KEY(cid))"+
			"ENGINE=innodb;"
			);
			System.out.println("Company table has been created successfully.");

			
			System.out.println("Creating table apply...");
			
			stmt.executeUpdate("CREATE TABLE apply ("+
			"sid CHAR(12),"+
			"cid CHAR(8),"+
			"PRIMARY KEY(sid,cid), "+
			"FOREIGN KEY (cid) REFERENCES company(cid) , "+
			"FOREIGN KEY (sid) REFERENCES student(sid))"+
			"ENGINE=innodb;"
			);
			
			System.out.println("apply table has been created successfully.");
			
			
			
			//INSERTING PROCESSS
			System.out.println("Inserting values into student table...");
			stmt.execute("INSERT INTO student VALUES"+
			"('21000001','John','1999-05-14','Windy','Chicago','senior','2.33','US') ," +
			"('21000002','Ali','2001-09-30','Nisantasi','Istanbul','junior','3.26','TC') ," +
			"('21000003','Veli','2003-02-25','Nisantasi','Istanbul','freshman','2.41','TC') ," +
			"('21000004','Ayse','2003-01-15','Tunali','Ankara','freshman','2.55','TC');" );
			System.out.println("Inserting has been done to student table.!");
			
			
			
			System.out.println("Inserting values into company table...");
			stmt.execute("INSERT INTO company VALUES"+
			"('C101','microsoft','2') ," +
			"('C102','merkez bankasi','5') ," +
			"('C103','tai','3') ," +
			"('C104','tubitak','5') ," +
			"('C105','aselsan','3') ," +
			"('C106','havelsan','4') ," +
			"('C107','milsoft','2');"  
					);
			System.out.println("Inserting has been done to company table.!");
			
			
			
			System.out.println("Inserting values into apply table...");
			stmt.execute("INSERT INTO apply VALUES"+
			"('21000001','C101') ," +
			"('21000001','C102') ," +
			"('21000001','C103') ," +
			"('21000002','C101') ," +
			"('21000002','C105') ," +
			"('21000003','C104') ," +
			"('21000003','C105') ," +
			"('21000004','C107') ;" 		
					);
			System.out.println("Inserting has been done to student table.!");
						
			
			System.out.println("------STUDENT----------");
			System.out.printf("%12s | %12s | %12s | %12s | %12s | %12s | %12s | %12s%n", "sid", "sname", "bdate", "address", "scity", "year", "gpa", "nationality");
			ResultSet students = stmt.executeQuery("SELECT * FROM student");
			while(students.next()) {
				System.out.printf("%12s | %12s | %12s | %12s | %12s | %12s | %12s | %12s%n", students.getString("sid"), 
						students.getString("sname"), students.getString("bdate"),students.getString("address"),
						students.getString("scity"),students.getString("year"), students.getString("gpa"), students.getString("nationality"));
				
			}
			
			
			System.out.println("------COMPANY----------");
			System.out.printf("%12s | %20s | %12s%n", "cid", "cname", "quota");
			ResultSet companies = stmt.executeQuery("SELECT * FROM company");
			while(companies.next()) {
				System.out.printf("%12s | %20s | %12s%n", companies.getString("cid"), 
						companies.getString("cname"),companies.getString("quota") 
						);
				
			}
			
			System.out.println("------APPLY----------");
			System.out.printf("%12s | %12s %n", "sid", "cid");
			ResultSet applications = stmt.executeQuery("SELECT * FROM apply");
			while(applications.next()) {
				System.out.printf("%12s | %12s%n", applications.getString("sid"),applications.getString("cid"));
				
			}

		} catch (SQLException e) {
			
			System.out.println("SQLException: "+e.getMessage());
		
		}
	}
	
}
