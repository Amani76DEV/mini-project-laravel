<?php 

interface HandlerInterface
{
    public function setNext(HandlerInterface $handlerInterface);
    public function handle($request);
    public function next($request);
}

abstract class abstractHandler implements HandlerInterface
{
    protected $next;
    public function setNext(HandlerInterface $handlerInterface)
    {
        $this->next = $handlerInterface;
    }
    public function next($request)
    {
        if($this->next){
            return $this->next->handle($request);
        }
    }
}

class ShouldLogin extends abstractHandler
{
    public function handle($request)
    {
        if($request['user_id'] == null){
            throw new Exception('should login');
        }
        echo "user is login";
        return $this->next($request);
    }
}
class ShouldRole extends abstractHandler
{
    public function handle($request)
    {
        if($request['role'] == null){
            throw new Exception('should role');
        }
        echo "user is role";
        return $this->next($request);
    }
}

$request = [
    'user_id' => 1,
    'role' => 'admin'
];
$login = new ShouldLogin();
$role = new ShouldRole();
    
$login->setNext($role);
$login->handle($request);