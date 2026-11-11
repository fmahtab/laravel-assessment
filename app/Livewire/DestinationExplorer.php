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
        $searchTerm = $this->searchTerm;

        if (empty($searchTerm)) {
            $this->filteredDestinations = $this->destinations;
            return;
        }

        $this->filteredDestinations = array_filter($this->destinations, function ($destination) use ($searchTerm) {
            return str_contains($destination['name'], $searchTerm) ||
                str_contains($destination['country'], $searchTerm) ||
                str_contains($destination['region'], $searchTerm) ||
                str_contains($destination['cost_level'], $searchTerm) ||
                str_contains(json_encode($destination['activities']), $searchTerm) ||
                str_contains($destination['average_daily_budget'], $searchTerm);
        });
    }

    public function resetSearch()
    {
        $this->searchTerm = '';
        $this->filteredDestinations = $this->destinations;
    }

    public function sort($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $sorted = $this->filteredDestinations;
        usort($sorted, function ($a, $b) use ($field) {
            if ($this->sortDirection === 'asc') {
                return $a[$field] > $b[$field] ? 1 : -1;
            } else {
                return $a[$field] < $b[$field] ? 1 : -1;
            }
        });
        $this->filteredDestinations = $sorted;
    }

    public function render()
    {
        return view('livewire.destination-explorer');
    }

}
