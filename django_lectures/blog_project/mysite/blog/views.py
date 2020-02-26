from django.shortcuts import render,get_object_or_404,redirect
from django.utils import timezone
from .models import Post, Comment # .models beceause this views and models are in the same directory
from blog.forms import PostForm,CommentForm
from django.urls import reverse_lazy
from django.contrib.auth.decorators import login_required #using with function based views
from django.contrib.aut.mixins import LoginRequiredMixin #When using class-based views, you can achieve the same behavior as with login_required by using the LoginRequiredMixin
from django.views.generic import(TemplateView,ListView,
                                    DetailView,CreateView,UpdateView,DeleteView)

# Create your views here.
class AboutView(TemplateView):
    template_name = 'blog/about.html' # we're going to connect that to about.html

class PostListView(ListView):
    model = Post # connect this to the post's model

    def get_queryset(self):
        # doing a get_queryset (function base views) to only show posts published
        return Post.objects.filter(published_date__lte = timezone.now()).order_by('-published_date')) # https://docs.djangoproject.com/fr/3.0/topics/db/queries/

class PostDetailView(DetailView):
    model = Post

class CreatePostView(LoginRequiredMixin,CreateView):
    login_url = '/login/' # if person not logged in they should go to login
    redirect_field_name ='blog/post_deteail.html' #?
    form_class = PostForm # connecting form
    model = Post

class PostUpdateView(LoginRequiredMixin,UpdateView):
    login_url = '/login/' # if person not logged in they should go to login
    redirect_field_name ='blog/post_deteail.html' #?
    form_class = PostForm # connecting form
    model = Post

class PostDeleteView(LoginRequiredMixin,DeleteView):
    model = Post
    # However, you can't use reverse with success_url, because then reverse is called when the module is imported, before the urls have been loaded.
    # Overriding get_success_url is one option, but the easiest fix is to use reverse_lazy instead of reverse in CBVs.
    success_url = reverse_lazy('post_list')

class DraftListView(LoginRequiredMixin,ListView):
    login_url = '/login/'
    redirect_field_name ='blog/post_deteail.html'
    model = Post

    def get_queryset(self):
        return Post.objects.filter(published_date__isnull=True).order_by('created_date')


#######################################
## Functions that require a primary key match ##
#######################################
@login_required
# need one more function view in order to publish
def post_publish(request,pk):
    post = get_object_or_404(Post,pk):
    post.publish()  # call function publish in models.py
    return redirect('post_detail',pk =pk)
    # don't forget to make a url in urls.py

@login_required
def add_comment_to_post(request,pk):
    post = get_object_or_404(Post,pk=pk) #finding it in passen the post's model and primary KEY
    if request.method == 'POST': # if the request the methode is to post (someone enter something in the form)
    # Create a form instance with POST data
    form = CommentForm(request.POST)
    if form.is_valid():
        # create, but don't save the new comment
        comment = form.save(commit=False)# if they didn't anything up , we have the save of the forms
        comment.post = post # an attribute called Post which is connected by a foreign key which is the actual post
        # save the new comment
        comment.save()
        return redirect('post_detail',pk=post.pk)
    else:
        form = CommentForm()
        return render(request,'blog/comment_form.html',{'form': form}) #charging data of forms.py in dictionary contexte

@login_required
def comment_approve(request, pk):
    comment = get_object_or_404(Comment,pk) #Comment's model
    comment.approve()
    return redirect('post_detail', pk = comment.post.pk)

@login_required
def comment_remove(request,pk):
    comment = get_object_or_404(Comment,pk) #get comment
    post_pk = comment.post.pk # create a new variable to identify the post where this comment is deleting
    comment.delete() # and then delete comment
    return redirect('post_detail', pk=post_pk)
    # make a url in urls.py
