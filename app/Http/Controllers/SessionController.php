<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SessionRepositoryInterface;

class SessionController extends Controller
{
   private $sessionRepository;

   public function __construct(SessionRepositoryInterface $sessionRepository)
   {
       $this->sessionRepository = $sessionRepository;
   }

   public function index(Request $request)
   {
       return $this->sessionRepository->all($request->all());
   }

   public function show($id)
   {
       return $this->sessionRepository->show($id);
   }

   public function store(Request $request)
   {
       return $this->sessionRepository->store($request->all());
   }

   public function update($id, Request $request)
   {
       return $this->sessionRepository->update($id, $request->all());
   }

   public function destroy($id)
   {
       return $this->sessionRepository->destroy($id);
   }
}
