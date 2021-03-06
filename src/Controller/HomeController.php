<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use App\Repository\SchoolRepository;
use App\Repository\TeacherRepository;
use Symfony\Component\Security\Core\Security;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

    /**
     * @Route("/", name="homepage")
     * 
    */
    public function home(ObjectManager $manager, UserRepository $repo, SchoolRepository $schoolRepo, TeacherRepository $teacherRepo){

        $user = $this->getUser();

        if($user != "") {
            $role =$user->getWish();
            if($role == "simple"){}
            if($role == "admin"){
                return $this->adminDashboard($manager, $repo);
                }
            if($role == "teachers"){
                return $this->teacherHome($manager, $schoolRepo, $teacherRepo);
                }
            if($role == "students"){
                return $this->studentHome();
                }
            if($role == "households") {
                return $this->householdHome();
                }
        }
            return $this->render('home.html.twig');
    }

    /**
     * @Route("/home/", name="user_home")
     * 
    */
    public function userHome(){
            $user = $this->getUser();
            $role = $user->getWish();
            return $this->render('home.html.twig', [
                 'user' => $user,
                 'role' => $role
                 ]);

        
    }
    
    /**
     * Affiche le tableau de bord de l'administration
     *
     * @Route("/admin/", name="admin_home")
     */
    public function adminDashboard(ObjectManager $manager, UserRepository $repo){
        $users = $repo->findUsersByUnverified($manager, $repo);

                return $this->render('admin/home.html.twig', [
                    'users' => $users]);
        
    }
    
    /**
     * Affiche le tableau de bord de l'enseignant(e)
     * 
     * @Route("/teacher", name="teacher_home")
     * 
     * @return Response
     */
    public function teacherHome(ObjectManager $manager, SchoolRepository $schoolRepo, TeacherRepository $teacherRepo){
        $user = $this->getUser();
        $teacher = $teacherRepo->findOneByUser($user);

        return $this->render('teacher/home.html.twig', [
                    'user' => $user,
                    'teacher' => $teacher,
                    ]);

        
    }

    /**
     * Affiche le tableau de bord de l'etudiant(e)
     * 
     * @Route("/student", name="student_home")
     */
    public function studentHome(){
        $user = $this->getUser();

        return $this->render('student/home.html.twig', [
                    'user' => $user,
                    ]);

        
    }

    /**
     * Affiche le tableau de bord du foyer
     * 
     * @Route("/household", name="household_home")
     */
    public function householdHome(){
        $user = $this->getUser();

        return $this->render('household/home.html.twig', [
                    'user' => $user,
                    ]);

        
    } 
}
?>