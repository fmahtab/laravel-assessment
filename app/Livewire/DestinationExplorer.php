<?php

namespace App\Livewire;

use Livewire\Component;

class DestinationExplorer extends Component
{
    public $destinations = [];
    public $filteredDestinations = [];
    public $searchTerm = '';
    public $sortField = '';
    public $sortDirection = 'asc';

    public function mount()
    {
        $this->destinations = \App\Models\Destination::all()->toArray();

        $this->filteredDestinations = $this->destinations;
    }

   public function search()
    {
        $searchTerm = trim($this->searchTerm);

        if (empty($searchTerm)) {
            $this->filteredDestinations = $this->destinations;
            return;
        }

        $this->filteredDestinations = array_filter($this->destinations, function ($destination) use ($searchTerm) {
            return stripos($destination['name'], $searchTerm) !== false
                || stripos($destination['country'], $searchTerm) !== false
                || stripos($destination['region'], $searchTerm) !== false
                || stripos($destination['cost_level'], $searchTerm) !== false
                || stripos(json_encode($destination['activities']), $searchTerm) !== false
                || stripos($destination['average_daily_budget'], $searchTerm) !== false;
        });
        $this->useSortingLogic();
    }

    public function resetSearch()
    {
        $this->searchTerm = '';
        $this->filteredDestinations = $this->destinations;
        $this->useSortingLogic();
    }

    public function sort($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->useSortingLogic();
    }

    private function useSortingLogic()
    {
        if($this->sortField === ''){
            return;
        }
        $field = $this->sortField;

        $sorted = $this->filteredDestinations;
        usort($this->filteredDestinations, function ($a, $b) use ($field) {
            $result = $a[$field] <=> $b[$field];

            if ($this->sortDirection === 'desc') {
                return -$result;
            }
            return $result;
        });

    }


    public function render()
    {
        return view('livewire.destination-explorer');
    }

}
