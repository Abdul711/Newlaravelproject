
<ul class="nav navbar-nav">
              <li><a href="{{url('/')}}">Home</a></li>
              @foreach($categories as $category)
              
              <li><a href="{{url('category/'.$category['id'])}}">{{$category['category_name']}}<span class="caret"></span></a>
              @if(isset($sub_category[$category['id']][0]))
              <ul class="dropdown-menu">    
             
              @foreach($sub_category[$category['id']] as $sub)
           
                  <li><a href="{{url('sub_category/'.$sub['id'])}}">{{$sub['category_name']}}</a></li>
             @endforeach
     
 
                  </li>
                </ul>
                @endif
            
           
              </li>
              @endforeach
                </ul>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
