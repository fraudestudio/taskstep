<?php


declare(strict_type=1);

namespace TaskStep\Logic\Model;
/**
 * interface du DAO des projet
 * 
 */
interface ProjectDaoInterface
{
    /**
     * Return all the projects of an User
     * 
     * @return array of Projects
     */
    public function GetAll(int $iduser): array;

    /**
     * create a project,need a User 
     * 
     * @param Project $project the concerned project
     * @return int id of the created project
     */
    public function Create(Project $project):int;

    /**
     * return a project from an id
     * 
     * @param int $id id of the project
     * @return Project return the getted project
     */
    public function GetProject(int $id): Project;

    /**
     * Update e selected project
     * 
     * @param Project $toCopy project to copy into the latest one
     * @param int $id id of the updating project
     */
    public function Update(Project $toCopy, int $id);

    /**
     * Delete the id concerned project
     * 
     * @param int $id the project id
     */
    public function Delete(int $id);

    /**
     * Get all items concerned by the specified project
     * 
     * @param int $id Project ID
     */
    public function GetAllItemFromProject(int $id):array;



}