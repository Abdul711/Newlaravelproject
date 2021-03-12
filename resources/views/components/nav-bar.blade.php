
<ul class="nav navbar-nav">
              <li><a href="{{url('/')}}">Home</a></li>
              @foreach($categories as $category)
              
              <li><a href="{{url('category/'.$category['id'])}}">{{$category['category_name']}}<span class="caret"></span></a>
              <ul class="dropdown-menu">    
              @foreach($sub_category[$category['id']] as $sub)
           
                  <li><a href="{{url('sub_category/'.$sub['id'])}}">{{$sub['category_name']}}</a></li>
             @endforeach
     
                  </li>
                </ul>
            
           
              </li>
              @endforeach
                </ul>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
