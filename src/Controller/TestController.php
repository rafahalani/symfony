<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\Teacher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {
        $teacher = new Teacher();
        $teacher->setEmail('teacher@becode.org');
        $teacher->setName('Teachers God');


      $teacher->addStudent(new Student('Batman','batman@becode.org',25));
      $teacher->addStudent(new Student('superman','superduper','55'));

      $this->getDoctrine()->getManager()->persist($teacher);//like git add means : remember this save it for me
      $this->getDoctrine()->getManager()->flush(); //persist works only with flush


        //you can set a date here or the constructor once and it will work for every new object!

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'name' => $teacher->getName()
        ]);
    }

    /**
     * @Route("/view/student/{student}", name="view_student")
     */
    public function viewStudent(Student $student)
    {
        return $this->render('test/view.html.twig',[
            'student' => $student,
        ]);
    }

    /**
     * @Route("/view/teacher/{teacher}", name="view_teacher")
     */
    public function viewTeacher(Teacher $teacher)
    {
        return $this->render('test/teacher.html.twig',[
            'teacher' => $teacher,
        ]);
    }
}
