<p align="center"><img src="propFinder/public/panel-assets/img/dark/logo001.png" width="400" alt="Laravel Logo"></p>

## About PropFinder

propFinder is an innovative application that combines the real estate sector with the improvement of the quality of life of citizens. The platform is based on user-defined criteria and uses open public data to suggest the most suitable places to live.

The idea and the development initiated on the 1st Hellenic Datathon Competition organized by the Bank of Greece, and carried out by three postgraduate students of the Digital Governance program of the Department of Information and Communication Systems Engineering of the University of the Aegean.

**Team:** IContacT
- **Coordinator:** Maria Vasiliadou
- **Developer:** Dimos Karras
- **Support:** Giorgos Ziogas


**Files**
- Laravel Project (./propFinder)
- Database (./propfinder.sql)
- Swagger (./swagger)

## About Project

1. **Install Docker 🐳**

    Make sure Docker is installed and running on your machine. You can download it from https://www.docker.com.

2. **Import the Database 🗄️**

    - Before importing the database, make sure you have configured your environment (.env file):

        `cd propFinder`

        `cp .env.example .env`

    - Open phpMyAdmin (http://localhost:8090) and import the provided database (.sql file). In order to open this you will have to run the images first (Step 3).

3. **Launch the application 🚀**

    Run the web application using Docker Compose or your preferred method. 
    
    **Via Docker:** `cd /propFinder && vendor/bin/sail up -d`
    
    Once the containers are running, the app will be available in your browser (e.g., http://localhost:8000).

That's it! 🎉 You're all set to explore the **PropFinder** app.
We hope you enjoy using it!

**Warning:** If you have trouble on the ownership rights you should check:

- On Project Folder `sudo chown -R $USER:www-data propfinder_project`
- On Docker image var/www >  `chown -R sail:sail html`

<small>Propfinder is open-sourced web application licensed under the [MIT license](https://opensource.org/licenses/MIT).</small>
