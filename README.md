# Rental Virtual Machine

## Run

```bash
vagrant up
```

 Ember use many memory for run server and build. So we use for deployment `ember depoy` for deploy
 ember project on vagrant. 
 
 Rename `.env.vagrant` file to `.env` and run this command from Ember project.
 You need add your public ssh key to vagrant machine for deploy. You can do it using `ssh-copy-id`. Then run this.
```bash
ember deploy production --verbose --activate=true
```

## Usage

### Frontend
[rental.vm](http://rental.vm/)

### Backend
[127.0.0.1:8000](http://127.0.0.1:8000)