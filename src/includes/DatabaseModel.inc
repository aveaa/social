<?php
/*Copyright (c) 2018 Unionity. All rights reserved.
Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
3. All advertising materials mentioning features or use of this software must display the following acknowledgement: 
This product includes software developed by the organization.
4. Neither the name of the copyright holder nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
THIS SOFTWARE IS PROVIDED BY COPYRIGHT HOLDER "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL COPYRIGHT HOLDER BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.*/
namespace Unionity\OpenVK4\core\Database;
class DatabaseModel
{
    protected $connection;
    public function __construct($host, $user, $password, $db)
    {
        $this->connection = new \mysqli($host, $user, $password, $db);
        if(mysqli_connect_errno())
        {
            throw new \Exception();
        }
        $this->connection->set_charset("utf8");
    }
    public function openDatabse()
    {
        return new FancyDatabase($this);
    }
    public function query($query, ...$params)
    {
        $query = $this->connection->prepare($query);
        $typestring = "";
        foreach($params as &$param)
        {
            $typestring.=gettype($param)[0];
        }
        $query->bind_param($typestring, ...$params);
        if(!$query->execute())
        {
            throw new \Exception(mysqli_error($this->connection), mysqli_errno($this->connection));
        }
        $result = $query->get_result();
        if($result->num_rows === 0) return null;
        return $result;
    }
    public function query_raw($query)
    {
        return mysqli_query($this->connection, $query)->get_result();
    }
}