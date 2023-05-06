class EmploiAjax{
    constructor(url)
    {
        this.ajax= new XMLHttpRequest()
        this.url=url
        

    }

    Ajax(send,callback)
    {
        this.ajax.open("POST",this.url,true) 
        this.ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        this.ajax.onload=(res)=>{
            if (res.target.status == 200)
            {
                callback(null,res.target.response )
            }
            else{
                callback('Error',res.target.response)
            }
        }
        this.ajax.send(send)        
    }

}


