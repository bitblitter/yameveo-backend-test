We’re a news publisher platform. Our app allow our customers to directly input news and publish them into other external platforms. 
Write a command line script that publishes the news that have been previously uploaded by the user.

It should look something like:

````bash
$ publish "yameveo-hiring"

Publishing "yameveo-hiring"...

Publishing to XML API:
<?xml version="1.0" encoding="UTF-8"?>
<root>
  <id>yameveo-hiring</id>
  <name>Yameveo is hiring!</name>
  <text>text version of yameveo-hiring new</text>
  <html>&lt;p&gt;html version of yameveo-hiring new&lt;/p&gt;</html>   <tags>
    <element>yameveo</element>
    <element>hiring</element>
  </tags>
</root>

Publishing to JSON API:
{
  "id": "yameveo-hiring",
  "name": "Yameveo is hiring!",
  "text": "text version of yameveo-hiring new",
  "html": "<p>html version of yameveo-hiring new</p>",
  "tags": ["yameveo", "hiring"]
}

Publishing to CSV FTP:
id, name, text, html, tags
"yameveo-hiring", "Yameveo is hiring!", "text version of yameveo-hiring new","<p>html version of yameveo-hiring new</p>", "yameveo, hiring"

Stored new into local DB.

````

- Currently we only publish to the API's in the sample above, but we're thinking to implement new sources with new formats soon, please take this in consideration when creating the code.
- As you can imagine, there's no real API to hit, just create your objects and the place where you'd do the API call, just echo the body of the request with the expected format.
- At the end of publishing, you need to store it into our MySQL DB. You don't need to work in the persistence implementation, just have in mind that on the future we're planning to migrate to MongoDB.
- Focus on the design, as mentioned before, there's no need to integrate your code with API's or DB's, instead, print what is suggested in the sample.
- Provide Unit Testing. There's no need to unit test everything, just so we get an idea that you know how to properly unit test.
- Integration & Functional testing is a plus.

Send us the repo link, but including in the README any steps we must follow to initiate the application & the tests. Feel free to include some notes about design decisions.