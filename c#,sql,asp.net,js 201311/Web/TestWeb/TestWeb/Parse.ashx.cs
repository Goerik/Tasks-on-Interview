using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Web;
using System.Web.Script.Serialization;

namespace TestWeb
{
    public class Parse : IHttpHandler
    {

        public void ProcessRequest(HttpContext context)
        {
            context.Response.ContentType = "application/json";


            UserInfo objUser = Deserialize<UserInfo>(context);


            if (objUser != null)
            {
                if (objUser.Name == "" || objUser.Color == "" || objUser.Years == "" || objUser.FavTime == "")
                {
                    context.Response.Write("Error");
                }
                else
                {
                    context.Response.Write(@"{""Name"":""" + objUser.Name + @"""," +
                                           @"""Color"":""" + objUser.Color + @"""," +
                                           @"""Years"":""" + objUser.Years + @"""," +
                                           @"""FavTime"":""" + objUser.FavTime + @"""" +
                                           "}");
                }
            }
            else
            {
                context.Response.Write(@"{""error"":""General error""}");
            }

        }


        public T Deserialize<T>(HttpContext context)
        {
            //read the json string
            string jsonData = new StreamReader(context.Request.InputStream).ReadToEnd();

            //cast to specified objectType
            var obj = (T)new JavaScriptSerializer().Deserialize<T>(jsonData);

            //return the object
            return obj;
        }

        // we create a class object to hold the JSON value
        public class UserInfo
        {
            public string Name { get; set; }
            public string Color { get; set; }
            public string Years { get; set; }
            public string FavTime { get; set; }
        }



        public bool IsReusable
        {
            get
            {
                return false;
            }
        }
    }
}