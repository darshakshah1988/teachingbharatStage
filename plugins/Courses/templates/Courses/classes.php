<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $courses
 */
?>
<section class="course_list_banner">
        <div class="container">
            <div class="col-sm-12 nopadding">
                <div class="col-sm-7 clb-texts">
                    <h3>MASTER CALSSES</h3>
                    <h2>ADVANCED LEARNIG WITH EASE</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>

                </div>
                <div class="col-sm-4 col-sm-offset-1">
                    <?php echo $this->Html->image('new/master-class-banner.png', ['class' => 'img-full']) ?>
                </div>
            </div>
        </div>
    </section>
 
    <div class="new-grey">
        <div class="container">
            <div class="col-sm-12 new-c-area">
                <div class="col-sm-3 new-c-filter">
                    <div class="col-sm-12 new-c-filter-block">
                        <h2>Courses</h2>
                        <label class="d-radio">Upcoming
                          <input type="radio" name="radio" checked="checked">
                          <span class="checkmark-r"></span>
                        </label>
                        <label class="d-radio">Past
                          <input type="radio" name="radio">
                          <span class="checkmark-r"></span>
                        </label>
                    </div>
                    <div class="col-sm-12 new-c-filter-block">
                        <h2>Board / Target</h2>
                        <label class="d-check-sm">
                            CBSE
                            <input type="checkbox" checked="checked">
                            <span class="checkmark"></span>
                        </label>
                        <label class="d-check-sm">
                            ICSE
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                        <label class="d-check-sm">
                            IGCSE
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                        <label class="d-check-sm">
                            State Board
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-sm-12 new-c-filter-block">
                        <h2>Grade</h2>
                        <table class="check-table">
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        3rd
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        8th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        4th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        9th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        5th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        10th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        6th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        11th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        7th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        12th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-12 new-c-filter-block">
                        <h2>Subjects</h2>
                        <table class="check-table">
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        English
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        Hindi
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        Maths
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        Science
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        Biology
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        Physics
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        Chemistry
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        Subject Name
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        Subject Name
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        Subject Name
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-sm-9 new-c-list">
                    <div class="row">
                        <div class="col-sm-12 searchbar">
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Search a Teacher...">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                              </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col-sm-12 master-class-box">
                                <h2>The Secrets of learning a new language - French - Summer Program</h2>
                                <h5>Grades 8th - 9th <span>Tue 2 Jun, 11:00 AM</span></h5>
                                <table class="mcb-details">
                                    <tr>
                                        <td>
                                            <?php echo $this->Html->image('Authors/01.jpg', ['class' => '']) ?>
                                        </td>
                                        <td>
                                            <p>Teaching By</p>
                                            <h4>Zafreen Munshi</h4>
                                        </td>
                                        <td class="text-right">
                                            <p><span>Math & SST Expert</span></p>
                                            <h6>M. Tech IIT Bangalore</h6>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <table class="master-class-box-footer">
                                    <tr>
                                        <td><h3>642 Registered</h3></td>
                                        <td class="text-right"><a href="#" class="tb-btn-md">Register For Free<i class="glyphicon glyphicon-menu-right"></i></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12 master-class-box">
                                <h2>The Secrets of learning a new language - French - Summer Program</h2>
                                <h5>Grades 8th - 9th <span>Tue 2 Jun, 11:00 AM</span></h5>
                                <table class="mcb-details">
                                    <tr>
                                        <td><?php echo $this->Html->image('Authors/01.jpg', ['class' => '']) ?></td>
                                        <td>
                                            <p>Teaching By</p>
                                            <h4>Zafreen Munshi</h4>
                                        </td>
                                        <td class="text-right">
                                            <p><span>Math & SST Expert</span></p>
                                            <h6>M. Tech IIT Bangalore</h6>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <table class="master-class-box-footer">
                                    <tr>
                                        <td><h3>642 Registered</h3></td>
                                        <td class="text-right"><a href="#" class="tb-btn-md">Register For Free<i class="glyphicon glyphicon-menu-right"></i></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12 master-class-box">
                                <h2>The Secrets of learning a new language - French - Summer Program</h2>
                                <h5>Grades 8th - 9th <span>Tue 2 Jun, 11:00 AM</span></h5>
                                <table class="mcb-details">
                                    <tr>
                                        <td><?php echo $this->Html->image('Authors/01.jpg', ['class' => '']) ?></td>
                                        <td>
                                            <p>Teaching By</p>
                                            <h4>Zafreen Munshi</h4>
                                        </td>
                                        <td class="text-right">
                                            <p><span>Math & SST Expert</span></p>
                                            <h6>M. Tech IIT Bangalore</h6>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <table class="master-class-box-footer">
                                    <tr>
                                        <td><h3>642 Registered</h3></td>
                                        <td class="text-right"><a href="#" class="tb-btn-md">Register For Free<i class="glyphicon glyphicon-menu-right"></i></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12 master-class-box">
                                <h2>The Secrets of learning a new language - French - Summer Program</h2>
                                <h5>Grades 8th - 9th <span>Tue 2 Jun, 11:00 AM</span></h5>
                                <table class="mcb-details">
                                    <tr>
                                        <td><?php echo $this->Html->image('Authors/01.jpg', ['class' => '']) ?></td>
                                        <td>
                                            <p>Teaching By</p>
                                            <h4>Zafreen Munshi</h4>
                                        </td>
                                        <td class="text-right">
                                            <p><span>Math & SST Expert</span></p>
                                            <h6>M. Tech IIT Bangalore</h6>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <table class="master-class-box-footer">
                                    <tr>
                                        <td><h3>642 Registered</h3></td>
                                        <td class="text-right"><a href="#" class="tb-btn-md">Register For Free<i class="glyphicon glyphicon-menu-right"></i></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12 master-class-box">
                                <h2>The Secrets of learning a new language - French - Summer Program</h2>
                                <h5>Grades 8th - 9th <span>Tue 2 Jun, 11:00 AM</span></h5>
                                <table class="mcb-details">
                                    <tr>
                                        <td><?php echo $this->Html->image('Authors/01.jpg', ['class' => '']) ?></td>
                                        <td>
                                            <p>Teaching By</p>
                                            <h4>Zafreen Munshi</h4>
                                        </td>
                                        <td class="text-right">
                                            <p><span>Math & SST Expert</span></p>
                                            <h6>M. Tech IIT Bangalore</h6>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <table class="master-class-box-footer">
                                    <tr>
                                        <td><h3>642 Registered</h3></td>
                                        <td class="text-right"><a href="#" class="tb-btn-md">Register For Free<i class="glyphicon glyphicon-menu-right"></i></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12 master-class-box">
                                <h2>The Secrets of learning a new language - French - Summer Program</h2>
                                <h5>Grades 8th - 9th <span>Tue 2 Jun, 11:00 AM</span></h5>
                                <table class="mcb-details">
                                    <tr>
                                        <td><?php echo $this->Html->image('Authors/01.jpg', ['class' => '']) ?></td>
                                        <td>
                                            <p>Teaching By</p>
                                            <h4>Zafreen Munshi</h4>
                                        </td>
                                        <td class="text-right">
                                            <p><span>Math & SST Expert</span></p>
                                            <h6>M. Tech IIT Bangalore</h6>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <table class="master-class-box-footer">
                                    <tr>
                                        <td><h3>642 Registered</h3></td>
                                        <td class="text-right"><a href="#" class="tb-btn-md">Register For Free<i class="glyphicon glyphicon-menu-right"></i></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12 master-class-box">
                                <h2>The Secrets of learning a new language - French - Summer Program</h2>
                                <h5>Grades 8th - 9th <span>Tue 2 Jun, 11:00 AM</span></h5>
                                <table class="mcb-details">
                                    <tr>
                                        <td><?php echo $this->Html->image('Authors/01.jpg', ['class' => '']) ?></td>
                                        <td>
                                            <p>Teaching By</p>
                                            <h4>Zafreen Munshi</h4>
                                        </td>
                                        <td class="text-right">
                                            <p><span>Math & SST Expert</span></p>
                                            <h6>M. Tech IIT Bangalore</h6>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <table class="master-class-box-footer">
                                    <tr>
                                        <td><h3>642 Registered</h3></td>
                                        <td class="text-right"><a href="#" class="tb-btn-md">Register For Free<i class="glyphicon glyphicon-menu-right"></i></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12 master-class-box">
                                <h2>The Secrets of learning a new language - French - Summer Program</h2>
                                <h5>Grades 8th - 9th <span>Tue 2 Jun, 11:00 AM</span></h5>
                                <table class="mcb-details">
                                    <tr>
                                        <td><?php echo $this->Html->image('Authors/01.jpg', ['class' => '']) ?></td>
                                        <td>
                                            <p>Teaching By</p>
                                            <h4>Zafreen Munshi</h4>
                                        </td>
                                        <td class="text-right">
                                            <p><span>Math & SST Expert</span></p>
                                            <h6>M. Tech IIT Bangalore</h6>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <table class="master-class-box-footer">
                                    <tr>
                                        <td><h3>642 Registered</h3></td>
                                        <td class="text-right"><a href="#" class="tb-btn-md">Register For Free<i class="glyphicon glyphicon-menu-right"></i></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12 master-class-box">
                                <h2>The Secrets of learning a new language - French - Summer Program</h2>
                                <h5>Grades 8th - 9th <span>Tue 2 Jun, 11:00 AM</span></h5>
                                <table class="mcb-details">
                                    <tr>
                                        <td><?php echo $this->Html->image('Authors/01.jpg', ['class' => '']) ?></td>
                                        <td>
                                            <p>Teaching By</p>
                                            <h4>Zafreen Munshi</h4>
                                        </td>
                                        <td class="text-right">
                                            <p><span>Math & SST Expert</span></p>
                                            <h6>M. Tech IIT Bangalore</h6>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <table class="master-class-box-footer">
                                    <tr>
                                        <td><h3>642 Registered</h3></td>
                                        <td class="text-right"><a href="#" class="tb-btn-md">Register For Free<i class="glyphicon glyphicon-menu-right"></i></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12 master-class-box">
                                <h2>The Secrets of learning a new language - French - Summer Program</h2>
                                <h5>Grades 8th - 9th <span>Tue 2 Jun, 11:00 AM</span></h5>
                                <table class="mcb-details">
                                    <tr>
                                        <td><?php echo $this->Html->image('Authors/01.jpg', ['class' => '']) ?></td>
                                        <td>
                                            <p>Teaching By</p>
                                            <h4>Zafreen Munshi</h4>
                                        </td>
                                        <td class="text-right">
                                            <p><span>Math & SST Expert</span></p>
                                            <h6>M. Tech IIT Bangalore</h6>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <table class="master-class-box-footer">
                                    <tr>
                                        <td><h3>642 Registered</h3></td>
                                        <td class="text-right"><a href="#" class="tb-btn-md">Register For Free<i class="glyphicon glyphicon-menu-right"></i></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12 master-class-box">
                                <h2>The Secrets of learning a new language - French - Summer Program</h2>
                                <h5>Grades 8th - 9th <span>Tue 2 Jun, 11:00 AM</span></h5>
                                <table class="mcb-details">
                                    <tr>
                                        <td><?php echo $this->Html->image('Authors/01.jpg', ['class' => '']) ?></td>
                                        <td>
                                            <p>Teaching By</p>
                                            <h4>Zafreen Munshi</h4>
                                        </td>
                                        <td class="text-right">
                                            <p><span>Math & SST Expert</span></p>
                                            <h6>M. Tech IIT Bangalore</h6>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <table class="master-class-box-footer">
                                    <tr>
                                        <td><h3>642 Registered</h3></td>
                                        <td class="text-right"><a href="#" class="tb-btn-md">Register For Free<i class="glyphicon glyphicon-menu-right"></i></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>