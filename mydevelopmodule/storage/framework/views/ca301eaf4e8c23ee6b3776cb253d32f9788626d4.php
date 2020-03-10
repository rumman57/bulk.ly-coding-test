<?php $__env->startSection('content'); ?>
<div class="container-fluid app-body">
	 <h2>Recent Post Sent To Buffer</h2>
	   <form class="form-style form-style-2" method="POST" action="<?php echo e(route('post.search')); ?>">
        <p>
            <?php echo e(csrf_field()); ?>

            <input type="text" name="search"  placeholder="Search " required="1">
            <i class="icon-search"></i>
            <button class="color button small publish-question1" value="submit">Search</button>
        </p>
    </form>

     <form action="<?php echo e(route('post.searchbygroup')); ?>" method="POST">
     	<?php echo e(csrf_field()); ?>

     	  <div class="form-group formgroup5 row">
              <div class="col-sm-8 colstyle5">
                 <select class="form-control" name="document_type" id="con1"">
                    <option value="">Search By Groups</option>
                 <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   
					    <option value="<?php echo e($gp->type); ?>"><?php echo e($gp->type); ?></option>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                 </select>
                 <button class="color button small publish-question1" value="submit">Search</button>
              </div>
           </div>
     </form>

      <form action="<?php echo e(route('post.searchbydate')); ?>" method="POST">
      	<label>Search BY Date</label>
     	<?php echo e(csrf_field()); ?>

     	 <p>
            <?php echo e(csrf_field()); ?>

            <input type="date" name="datesearch"  required="1">
            <i class="icon-search"></i>
            <button class="color button small publish-question1" value="submit">Search</button>
        </p>
     </form>
    <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                 <tr>
                  <th style="text-align: center;" width="10%">Group Name</th>
                  <th style="text-align: center;" width="20%">Group Type</th>
                  <th style="text-align: center;" width="20%">Account Name</th>
                  <th style="text-align: center;" width="20%">Post Text</th>
                  <th style="text-align: center;" width="15%">Time</th>
                
                </tr>
                </thead>
                <tbody>
            <?php if(count($bposts)>0): ?>
              <?php $__currentLoopData = $bposts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $i++;?>
                <tr>
                  <td> <?php echo e($post->groupInfo->name); ?></td>
                  <td><?php echo e($post->groupInfo->type); ?></td>
                  
                  <td><img src="<?php echo e($post->accountInfo->avatar); ?>"  height="100" width="100"></td>
                  <td><?php echo $post->post_text; ?></td>
                  <td><?php echo e(date('j M ,Y H:i A',strtotime($post->created_at))); ?></td>
                  
                 
                </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
               <td>No Data</td>
              <?php endif; ?>
                </tbody>             
              </table>

                 <?php echo e($bposts->links()); ?>

            </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>